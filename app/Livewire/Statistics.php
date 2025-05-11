<?php

namespace App\Livewire;

use App\Models\Exercise;
use Livewire\Component;
use DB;
use Illuminate\Database\Query\JoinClause;
use Barryvdh\DomPDF\Facade\Pdf;

class Statistics extends Component
{
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

        $pdf = Pdf::loadView('statisticsPDF', ['detailedStats' => $detailedStats])
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

        } else {
            $this->detailedStats = DB::table('user_records')
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
                ->whereIn('exercises.part', $this->selectedParts)
                ->whereIn('exercises.id', $this->detailedSelectedExercises)
                ->where('users.id', '=', auth()->id())
                ->orderBy('user_records.timestamp', 'ASC')
                ->get();
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
