<?php

namespace App\Livewire\Exercise;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
class Launcher extends Component
{

    public $toDoStudents;
    public $confirmLaunch = false;

    public function triggerConfirm()
    {
        $this->confirmLaunch = !$this->confirmLaunch;
    }
    public $isOpen = false;
    public $results;
    public $titleEx;
    public $exerciseId;
    protected $listeners = ['openLauncher' => 'launch'];


    public function setExercise()
    {
        $students = User::where('school_id', Auth::user()->school_id)
            ->get();
        $ex = Exercise::find($this->exerciseId);
        foreach ($students as $student) {
            $student->set_exercise = $this->exerciseId;

            if ($student->id !== Auth::user()->id) {
                $mail = new Mail();
                $mail->from_user_id = Auth::user()->id;
                $mail->to_user_id = $student->id;
                $mail->subject = 'New exercise assigned';
                $mail->body = 'You have a new exercise assigned. Please check part '.$ex->part.'.';
                $mail->is_read = false;
                $mail->save();
            }
            $student->save();
        }

        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
        $this->confirmLaunch = !$this->confirmLaunch;
        $this->redirect(request()->header('Referer'));
    }
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

        $this->toDoStudents = null;

        if (Auth::user()->role == 'Student') {
            $this->results = DB::table('user_records')
                ->where('user_id', Auth::id())
                ->where('exercise_id', $this->exerciseId)
                ->orderBy('timestamp', 'desc')->get();
        } else {

            if ($this->exerciseId == Auth::user()->set_exercise) {
                $this->toDoStudents = User::where('school_id', Auth::user()->school_id)
                    ->where('set_exercise', $this->exerciseId)
                    ->get();
            }

            $this->results = DB::table('user_records')
                ->join('users', 'users.id', '=', 'user_records.user_id')
                ->where('user_records.exercise_id', $this->exerciseId)
                ->where('users.school_id', Auth::user()->school_id)
                ->where('users.id', '!=', Auth::user()->id)
                ->orderBy('user_records.timestamp', 'desc')
                ->select('user_records.*', 'users.name', 'users.surname')
                ->get();
        }



        return view('livewire.exercise.launcher');
    }

}
