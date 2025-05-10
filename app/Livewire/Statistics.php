<?php

namespace App\Livewire;

use App\Models\Exercise;
use Livewire\Component;
use DB;
use Illuminate\Database\Query\JoinClause;

class Statistics extends Component
{
    public $selectedParts = [];
    public $listExercises;

    public $detailedListExercises;
    public $stats;
    public $detailedStatsSelect;
    public array $selectedExercises = [];

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
