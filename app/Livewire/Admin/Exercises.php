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
    public function render()
    {
        $this->part1 = Exercise::where('part', 1)->get();
        $this->part2 = Exercise::where('part', 2)->get();
        $this->part3 = Exercise::where('part', 3)->get();
        $this->part4 = Exercise::where('part', 4)->get();
        return view('livewire.admin.exercises')->layout('layouts.app');
    }
}
