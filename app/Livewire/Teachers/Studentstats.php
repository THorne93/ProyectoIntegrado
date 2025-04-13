<?php

namespace App\Livewire\Teachers;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use DB;

class Studentstats extends ModalComponent
{

    public $isOpen = false;
    public $student;
    public $part1percent;
    public $part2percent;
    public $part3percent;
    public $part4percent;
    public $latestScores;
    public $isEdit = false;
    public function open()
    {
        $this->isOpen = true;
        $this->dispatch('lock-scroll');
    }

    public function openEdit() {
        $this->isEdit = true;
    }
    public function closeEdit() {
        $this->isEdit = false;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
    }

    protected $listeners = ['openStats' => 'loadStudent'];

    public function loadStudent($id)
    {
        $parts = [1, 2, 3, 4];
        foreach ($parts as $part) {
            $data = DB::table('user_records')
                ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
                ->where('user_records.user_id', $id)->where('exercises.part', $part)
                ->selectRaw('COUNT(user_records.score) as count, SUM(user_records.score) as sum, AVG(user_records.score) as average')
                ->first();
            $this->{"part{$part}percent"} = round((($data->average ?? 0) / 8) * 100);
        }
        $this->latestScores = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('user_records.user_id', $id)->orderBy('user_records.timestamp', 'desc')
            ->select('user_records.score', 'user_records.timestamp', 'exercises.title','exercises.part')->take(5)->get();
        
            $this->student = DB::table('users')
            ->leftJoin('user_records', function ($join) {
                $join->on('users.id', '=', 'user_records.user_id')
                    ->whereRaw('user_records.timestamp = (SELECT MAX(timestamp) FROM user_records WHERE user_records.user_id = users.id)');
            })
            ->where('users.id', $id)
            ->select('users.*', 'user_records.timestamp as date')
            ->first();
        $this->isOpen = true;
    }
    public function render()
    {

        return view('livewire.teachers.studentstats');
    }
}
