<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Exercise;
use Carbon\Carbon;
use Livewire\Component;
use DB;
use Illuminate\Database\Query\JoinClause;
use Barryvdh\DomPDF\Facade\Pdf;

class Statistics extends Component
{
    public $student;
    public $prediction;
    public $threshold = 70;
    public $selectedParts = [];
    public $listExercises;
    public $detailedStatsLimit = 0;
    public $userName;
    public $detailedListExercises;
    public $detailedSelectedExercises = [];
    public $stats;
    public $detailedStatsSelect;
    public array $selectedExercises = [];

    public $detailedStats;
    public function updatedDetailedStatsSelect($value)
    {
        $parts = collect($this->selectedParts ?? [])
            ->push($value)
            ->unique()
            ->filter(); // remove nulls or empty strings

        if ($parts->isNotEmpty()) {
            $this->detailedListExercises = Exercise::whereIn('part', $parts)->get();
        } else {
            $this->detailedListExercises = collect();
        }
    }



    public function updatedSelectedParts()
    {
        if (!empty($this->selectedParts)) {
            $this->detailedListExercises = Exercise::whereIn('part', $this->selectedParts)->get();
        } else {
            $this->detailedListExercises = collect();
        }
    }

    public function printPDF()
    {
        $detailedStats = $this->detailedStats;
        $this->getPrediction();
        $pdf = Pdf::loadView('statisticsPDF', ['detailedStats' => $detailedStats, 'prediction' => $this->prediction])
            ->setOptions([
                'defaultFont' => 'dejavu sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();  // Use output() instead of stream() for downloadable file
        }, 'statistics.pdf');
    }

    public function getDetailedStats()
    {
        if ($this->detailedStatsSelect === 'all') {
            $allStats = collect();
            $allExercises = Exercise::whereIn('part', $this->selectedParts)->get();
            foreach ($allExercises as $exercise) {
                $stats = DB::table('user_records')
                    ->join('users', 'user_records.user_id', '=', 'users.id')
                    ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
                    ->select(
                        'user_records.id as record_id',
                        'user_records.timestamp as record_date',
                        'users.name as user_name',
                        'users.id as user_id',
                        'user_records.score as score',
                        'user_records.time_spent as time',
                        'exercises.title as title',
                        'exercises.part as part'
                    )
                    ->where('users.id', auth()->id())
                    ->where('exercises.id', $exercise->id)
                    ->orderBy('user_records.timestamp', 'ASC')
                    ->when($this->detailedStatsLimit > 0, function ($query) {
                        return $query->limit($this->detailedStatsLimit);
                    })
                    ->get();
                $allStats = $allStats->merge($stats);
            }


        } else {
            $allStats = collect();

            foreach ($this->detailedSelectedExercises as $exercise) {
                $stats = DB::table('user_records')
                    ->join('users', 'user_records.user_id', '=', 'users.id')
                    ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
                    ->select(
                        'user_records.id as record_id',
                        'user_records.timestamp as record_date',
                        'users.name as user_name',
                        'users.id as user_id',
                        'user_records.score as score',
                        'user_records.time_spent as time',
                        'exercises.title as title',
                        'exercises.part as part'
                    )
                    ->where('users.id', auth()->id())
                    ->where('exercises.id', $exercise)
                    ->orderBy('user_records.timestamp', 'ASC')
                    ->when($this->detailedStatsLimit > 0, function ($query) {
                        return $query->limit($this->detailedStatsLimit);
                    })
                    ->get();
                $allStats = $allStats->merge($stats);
            }
        }
        $this->userName = $allStats->isNotEmpty() ? $allStats->first()->user_name : 'Unknown User';
        $this->detailedStats = $allStats
            ->sort(function ($a, $b) {
                $partCompare = $a->part <=> $b->part;
                if ($partCompare !== 0)
                    return $partCompare;
                return strcmp($b->record_date, $a->record_date);
            })
            ->groupBy('title')
            ->map(fn($group) => $group->values())
            ->toArray();
    }

    public function getPrediction()
    {
        $this->prediction = $this->predictor();
    }

    public function predictor()
    {

        $timestamps = [];
        $percentages = [];

        foreach ($this->detailedStats as $exercise) {
            foreach ($exercise as $entry) {
                $time = Carbon::parse($entry->record_date)->timestamp;
                $percent = ($entry->score / ($entry->part != '4' ? 8 : 12)) * 100;
                $timestamps[] = $time;
                $percentages[] = $percent;
            }
        }
        $last4 = array_slice($percentages, -4);
        $aboveThreshold = array_filter($last4, fn($p) => $p >= $this->threshold);
        if (count($aboveThreshold) >= 3) {
            return "The student is consistently ready to pass (≥70% in at least 3 of the last 4 attempts).";
        }
        $last5 = array_slice($percentages, -5);
        $averageLast5 = array_sum($last5) / count($last5);
        if ($averageLast5 >= $this->threshold) {
            return "The student's average score over the last 5 attempts is above the threshold.";
        }
        $n = count($timestamps);
        $sumX = array_sum($timestamps);
        $sumY = array_sum($percentages);
        $sumXY = array_sum(array_map(function ($pair) {
            return $pair[0] * $pair[1];
        }, array_map(null, $timestamps, $percentages)));
        $sumX2 = array_sum(array_map(fn($x) => $x * $x, $timestamps));

        $denominator = $n * $sumX2 - $sumX ** 2;
        if ($denominator == 0) {
            return "Not enough data variation to predict.";
        }

        $slope = ($n * $sumXY - $sumX * $sumY) / $denominator;
        $intercept = ($sumY - $slope * $sumX) / $n;

        if ($slope <= 0) {
            return "Not quite ready yet — keep practising and you will be!";
        }

        $targetTimestamp = ($this->threshold - $intercept) / $slope;
        $targetDate = Carbon::createFromTimestamp((int) $targetTimestamp);

        $today = Carbon::now();

        if ($targetDate->lessThanOrEqualTo($today)) {
            return "Based on the data, the you are ready now!";
        }

        if ($targetDate->greaterThan($today) && $targetDate->lessThanOrEqualTo($today->copy()->addMonths(6))) {
            return "You're not ready yet, but you're close. You should be ready by: <strong>{$targetDate->toFormattedDateString()}</strong>";
        }


    }

    public function render()
    {
        $stats = DB::table('user_records')
            ->join('users', function (JoinClause $join) {
                $join->on('user_records.user_id', '=', 'users.id');
            })
            ->join('exercises', function (JoinClause $join) {
                $join->on('user_records.exercise_id', '=', 'exercises.id');
            })
            ->select(
                'user_records.id as record_id',
                'user_records.timestamp as record_date',
                'users.name as user_name',
                'users.id as user_id',
                'user_records.score as score',
                'exercises.title as title',
                'exercises.part as part'
            )
            ->where('users.id', '=', auth()->id())
            ->orderBy('user_records.timestamp', 'ASC')
            ->get();

        $this->stats = $stats;
        return view('livewire.statistics')->layout('layouts.app');
    }
}
