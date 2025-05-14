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
    public $filterTrashed = false;

    public function toggleTrashed() {
        $this->filterTrashed = !$this->filterTrashed;
    }
    public function toggleCards()
    {
        $this->view = "cards";
    }
    public function toggleTable()
    {
        $this->view = "table";
    }
    #[On('newSchool')]
    #[On('updateSchool')]

    public function render()
    {
        if (!$this->filterTrashed) {
            $this->schools = School::where('name', 'like', '%' . $this->search . '%')->get();

        } else {
            $this->schools = School::onlyTrashed()->where('name', 'like', '%' . $this->search . '%')->get();

        }
        return view('livewire.admin.schools')->layout('layouts.app');
    }
}
