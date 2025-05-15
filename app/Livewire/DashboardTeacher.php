<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardTeacher extends Component
{
    public $studentStats;


    public function render()
    {
        $this->studentStats = $this->getStudentStats();

        return view('livewire.dashboard-teacher')->layout('layouts.app');
    }
    public function goToStatistics($id)
    {
        session(['selected_student_id' => $id]);
        return redirect()->route('statistics');
    }

    public function getStudentStats()
    {
        $studentStats = collect();
        $students = User::where('school_id', Auth::user()->school_id)
            ->where('role', '!=', 'teacher')
            ->where('id', '!=', Auth::id())
            ->get();

        foreach ($students as $student) {
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
                ->where('users.id', $student->id)
                ->orderBy('user_records.timestamp', 'DESC')
                ->limit(10)
                ->get();

            $studentStats->push([
                'name' => $student->name . ' ' . $student->surname,
                'id' => $student->id,
                'scores' => $stats->reverse()->map(function ($score) {
                    return [
                        ...get_object_vars($score),
                        'percent' => $score->part == '4'
                            ? ($score->score / 12) * 100
                            : ($score->score / 8) * 100,
                        'score' => $score->part == '4'
                            ? "{$score->score} / 12"
                            : "{$score->score} / 8",
                        'record_date' => \Carbon\Carbon::parse($score->record_date)->format('d/m/Y'),
                    ];
                })->values()->toArray(),
            ]);
        }
        return $studentStats;
    }
}
