<?php

namespace App\Livewire\Exercise;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
class Launcher extends Component
{

    public $isOpen = false;
    public $results;
    public $titleEx;
    public $exerciseId;
    protected $listeners = ['openLauncher' => 'launch'];



    public function launch($id)
    {
        $this->exerciseId = $id;
        $this->titleEx = Exercise::find($id);
        $this->isOpen = true;
    }


    public function close()
    {
        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
    }


    public function render()
    {

        if (Auth::user()->role == 'Student') {
            $this->results = DB::table('user_records')
                ->where('user_id', Auth::id())
                ->where('exercise_id', $this->exerciseId)
                ->orderBy('timestamp', 'desc')->get();
        } else {
            $this->results = DB::table('user_records')
                ->join('users', 'users.id', '=', 'user_records.user_id')
                ->where('user_records.exercise_id', $this->exerciseId)
                ->where('users.school_id', Auth::user()->school_id)
                ->where('users.id', '!=', Auth::id()) // Exclude current user
                ->orderBy('user_records.timestamp', 'desc')
                ->select('user_records.*', 'users.name', 'users.surname')
                ->get();
        }



        return view('livewire.exercise.launcher');
    }

}
