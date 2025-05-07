<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\On;
use App\Models\School;
use Livewire\Component;

class Schools extends Component
{
    public $schools;
    public $view = "cards";
    public $search;
    public $column;
    

    public function toggleCards()
    {
        $this->view ="cards";
    }
    public function toggleTable()
    {
        $this->view ="table";
    }
    #[On('newSchool')]
    #[On('updateSchool')]

    public function render()
    {
        $this->schools = School::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.schools')->layout('layouts.app');
    }
}
