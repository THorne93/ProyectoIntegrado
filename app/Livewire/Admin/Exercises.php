<?php

namespace App\Livewire\Admin;
use App\Models\Exercise;
use Livewire\Component;

class Exercises extends Component
{
    public $part1;
    public $part2;
    public $part3;
    public $part4;
    public $search1;
    public $search2;
    public $search3;
    public $search4;
    public function render()
    {
        $this->part1 = Exercise::where('part', 1)->where('title', 'like', '%' . $this->search1 . '%')->get();
        $this->part2 = Exercise::where('part', 2)->where('title', 'like', '%' . $this->search2 . '%')->get();
        $this->part3 = Exercise::where('part', 3)->where('title', 'like', '%' . $this->search3 . '%')->get();
        $this->part4 = Exercise::where('part', 4)->where('title', 'like', '%' . $this->search4 . '%')->get();

        return view('livewire.admin.exercises')->layout('layouts.app');
    }
}
