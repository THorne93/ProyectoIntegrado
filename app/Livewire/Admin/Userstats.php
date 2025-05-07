<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\School;
use Livewire\Attributes\On;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use DB;
class Userstats extends ModalComponent
{

    public $isOpen = false;
    public $student;

    public $f_name;
    public $l_name;
    public $password;
    public $password_confirmation;
    public $is_teacher;

    public $part1percent;
    public $part2percent;
    public $part3percent;
    public $part4percent;
    public $latestScores;
    public $isEdit = false;
    public $success = false;
    public $schools;
    public $selectedSchool = '';
    public function open()
    {
        $this->isOpen = true;
        $this->dispatch('lock-scroll');
    }

    public function openEdit()
    {
        $this->isEdit = true;
    }
    public function closeEdit()
    {
        $this->isEdit = false;
    }


    #[On('success')]
    public function changeSuccess()
    {
        $this->success = true;
    }
    public function close()
    {
        $this->selectedSchool = '';
        $this->isOpen = false;
        $this->isEdit = false;
        $this->dispatch('unlock-scroll');
    }

    public function updatedSelectedSchool($value)
    {
        if (!is_numeric($value)) {
            $this->is_teacher = false;
        }
    }
    public function editStudent()
    {
        $this->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $student = User::findOrFail($this->student->id);

        $student->name = $this->f_name;
        $student->surname = $this->l_name;
        $student->role = $this->is_teacher ? 'Teacher' : 'Student';
        $student->school_id = $this->selectedSchool ?: null;
        if (!empty($this->password)) {
            $student->password = Hash::make($this->password);
        }
        $student->save();
        $this->loadStudent($this->student->id);
        $this->dispatch('success');
        $this->dispatch('updateUser');


    }

    protected $listeners = ['openUserStats' => 'loadStudent'];

    public function loadStudent($id)
    {
        $parts = [1, 2, 3, 4];
        foreach ($parts as $part) {
            $data = DB::table('user_records')
                ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
                ->where('user_records.user_id', $id)->where('exercises.part', $part)
                ->selectRaw('COUNT(user_records.score) as count, SUM(user_records.score) as sum, AVG(user_records.score) as average')
                ->first();
            $this->{"part{$part}percent"} = round((($data->average ?? 0) / ($part == 4 ? 12 : 8)) * 100);
        }
        $this->latestScores = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('user_records.user_id', $id)->orderBy('user_records.timestamp', 'desc')
            ->select('user_records.score', 'user_records.timestamp', 'exercises.title', 'exercises.part')->take(5)->get();

        $this->student = DB::table('users')
            ->leftJoin('user_records', function ($join) {
                $join->on('users.id', '=', 'user_records.user_id')
                    ->whereRaw('user_records.timestamp = (SELECT MAX(timestamp) FROM user_records WHERE user_records.user_id = users.id)');
            })
            ->where('users.id', $id)
            ->select('users.*', 'user_records.timestamp as date', 'users.school_id')->first();

        $this->selectedSchool = $this->student->school_id ?? '';
        $this->f_name = $this->student->name;
        $this->l_name = $this->student->surname;
        $this->is_teacher = $this->student->role === 'Teacher';
        $this->isOpen = true;
    }

    public function render()
    {
        $this->schools = School::all();
        return view('livewire.admin.userstats');
    }
}
