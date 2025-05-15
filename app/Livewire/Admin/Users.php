<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;


class Users extends Component
{
    public $successDelete = false;
    public $successRestore = false;
    public $users;
    public $view = "cards";
    public $filterTrashed = false;
    public $search;

    public $orderDirection = "desc";
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

    public function toggleTrashed()
    {
        $this->filterTrashed = !$this->filterTrashed;
    }
    public function toggleTable()
    {
        $this->view = "table";
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
    #[On('updateUser')]
    #[On('newUser')]
    public function render()
    {

        if (!$this->filterTrashed) {
            $this->users = User::query()
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id')
                ->where(function ($query) {
                    $query->where('users.name', 'like', '%' . $this->search . '%')
                        ->orWhere('users.surname', 'like', '%' . $this->search . '%')
                        ->orWhere('users.email', 'like', '%' . $this->search . '%')
                        ->orWhere('schools.name', 'like', '%' . $this->search . '%');
                })
                ->select('users.*')->orderBy($this->column, $this->orderDirection)
                ->get();
        } else {
            $this->users = User::onlyTrashed()
                ->leftJoin('schools', 'users.school_id', '=', 'schools.id')
                ->where(function ($query) {
                    $query->where('users.name', 'like', '%' . $this->search . '%')
                        ->orWhere('users.surname', 'like', '%' . $this->search . '%')
                        ->orWhere('users.email', 'like', '%' . $this->search . '%')
                        ->orWhere('schools.name', 'like', '%' . $this->search . '%');
                })
                ->select('users.*')->orderBy($this->column, $this->orderDirection)
                ->get();
        }

        return view('livewire.admin.users')->layout('layouts.app');
    }

}
