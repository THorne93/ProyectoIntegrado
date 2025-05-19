<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\On;
use App\Models\School;
use Livewire\Component;

class Schools extends Component
{
    public $successDelete = false;
    public $successRestore = false;
    public $schools;
    public $view = "cards";
    public $search;
    public $orderDirection = "asc";
    public $column = "name";
    public $filterTrashed = false;

    public function toggleTrashed()
    {
        $this->filterTrashed = !$this->filterTrashed;
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
    public function toggleCards()
    {
        $this->view = "cards";
    }

    #[On('deleteSchool')]
    public function changeDeleteSuccess()
    {
        $this->successDelete = true;
    }
    #[On('restoreSchool')]
    public function changeRestoreSuccess()
    {
        $this->successRestore = true;
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
            $this->schools = School::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->column, $this->orderDirection)->get();

        } else {
            $this->schools = School::onlyTrashed()->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->column, $this->orderDirection)->get();

        }
        return view('livewire.admin.schools')->layout('layouts.app');
    }
}
