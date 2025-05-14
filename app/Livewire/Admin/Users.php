<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;


class Users extends Component
{

    public $users;
    public $view = "cards";
    public $filterTrashed = false;
    public $search;
    public $column;
    public function toggleCards()
    {
        $this->view = "cards";
    }

    public function toggleTrashed()
    {
        $this->filterTrashed = !$this->filterTrashed;
    }
    public function toggleTable()
    {
        $this->view = "table";
    }
    #[On('updateUser')]
    #[On('newUser')]
    public function render()
    {
        $this->users = User::query()
            ->leftJoin('schools', 'users.school_id', '=', 'schools.id')
            ->where(function ($query) {
                $query->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.surname', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('schools.name', 'like', '%' . $this->search . '%');
            })
            ->select('users.*') // important to select users only
            ->get();

        return view('livewire.admin.users')->layout('layouts.app');
    }

}
