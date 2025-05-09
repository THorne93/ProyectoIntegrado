<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Newschool extends Component
{
    public $students;
    public $school;
    public $success = false;
    public $isOpen = false;
    public $name, $address, $phone, $email, $password;
    public $selectedStudents = [];
    public $selectedTeacher = null;

    #[On('success')]
    public function changeSuccess()
    {
        $this->success = true;
    }

    public function updatedSelectedStudents($value)
    {
        // If the currently selected teacher is no longer in the list of selected students, reset it
        if (!in_array($this->selectedTeacher, $this->selectedStudents)) {
            $this->selectedTeacher = null;
        }
    }
    public function open()
    {
        $this->isOpen = true;
        $this->dispatch('lock-scroll');
    }

    public function close()
    {
        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
    }
    protected $listeners = ['openSchoolModal' => 'open'];

    public function render()
    {
        $this->students = User::whereNull('school_id')
            ->get();
        return view('livewire.admin.newschool');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:schools,email',
            'password' => 'required|string|min:6',
        ]);

        // Create the school
        $school = School::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : null,
        ]);
        $this->school = $school;
        if (!empty($this->selectedTeacher)) {
            User::where('school_id', $this->school->id)->update(['role' => 'Student']);
            User::where('id', $this->selectedTeacher)->update(['role' => 'Teacher']);
        }
        if (!empty($this->selectedStudents)) {
            User::whereIn('id', $this->selectedStudents)->update(['school_id' => $school->id]);
        }
        $this->dispatch('success');
        $this->dispatch('newSchool');
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->selectedStudents = [];
        $this->selectedTeacher = null;
        $this->students = User::whereNull('school_id')
            ->get();
    }

}
