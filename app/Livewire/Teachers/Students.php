<?php

namespace App\Livewire\Teachers;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Students extends Component
{

    public $successDelete = false;
    public $successRestore = false;
    public $students;
    public $view = "cards";
    public $search;
    public $school;

    public $orderDirection = "asc";
    public $column = "name";
    public function toggleCards()
    {
        $this->view = "cards";
    }

    public function order($order)
    {

        if ($this->column == $order) {
            if ($this->orderDirection == "desc") {
                $this->orderDirection = "asc";
            } else
                $this->orderDirection = "desc";
        } else {
            $this->column = $order;
            $this->orderDirection = "desc";
        }
    }

    #[On('deleteUser')]
    public function changeDeleteSuccess()
    {
        $this->successDelete = true;
    }
    #[On('restoreUser')]
    public function changeRestoreSuccess()
    {
        $this->successRestore = true;
    }
    public function toggleTable()
    {
        $this->view = "table";
    }
    public $filterTrashed = false;

    public function toggleTrashed()
    {
        $this->filterTrashed = !$this->filterTrashed;
    }

    #[On('editStudent')]
    #[On('newUser')]
    public function render()
    {
        $this->school = Auth::user()->school;
        if (!$this->filterTrashed) {
            $this->students = User::where('school_id', $this->school->id)
                ->where('users.id', '!=', Auth::id())
                ->where('role', '!=', 'Teacher')
                ->leftJoin('user_records as ur', function ($join) {
                    $join->on('users.id', '=', 'ur.user_id')
                        ->whereRaw('ur.timestamp = (
                SELECT MAX(timestamp)
                FROM user_records
                WHERE user_records.user_id = users.id
            )');
                })
                ->select('users.*', 'ur.score', 'ur.timestamp as date')
                ->orderBy($this->column, $this->orderDirection)
                ->get();
        } else {
            $this->students = User::onlyTrashed()
                ->where('school_id', $this->school->id)
                ->where('users.id', '!=', Auth::id())
                ->leftJoin('user_records as ur', function ($join) {
                    $join->on('users.id', '=', 'ur.user_id')
                        ->whereRaw('ur.timestamp = (
                SELECT MAX(timestamp)
                FROM user_records
                WHERE user_records.user_id = users.id
            )');
                })
                ->select('users.*', 'ur.score', 'ur.timestamp as date')
                ->orderBy($this->column, $this->orderDirection)
                ->get();
        }

        return view('livewire.teachers.students')->layout('layouts.app');
    }
}
