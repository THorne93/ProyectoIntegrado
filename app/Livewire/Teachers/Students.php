<?php

namespace App\Livewire\Teachers;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Students extends Component
{

    public $students;


    #[On('editStudent')]
    #[On('newUser')]
    public function render()
    {
        $school = Auth::user()->school;
        $this->students = DB::table('users')
            ->leftJoin('user_records', function ($join) {
                $join->on('users.id', '=', 'user_records.user_id')
                    ->whereRaw('user_records.timestamp = (SELECT MAX(timestamp) FROM user_records WHERE user_records.user_id = users.id)');
            })
            ->where('users.school_id', $school->id)
            ->whereNot('users.id', Auth::id())
            ->select('users.*', 'user_records.score', 'user_records.timestamp as date')
            ->get();
        return view('livewire.teachers.students')->layout('layouts.app');
    }
}
