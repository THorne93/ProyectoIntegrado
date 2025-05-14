<?php

namespace App\Livewire\Admin;
use App\Models\School;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Attributes\On;

use Livewire\Component;

class Schoolstats extends ModalComponent
{

    public $school;
    public $isEdit = false;
    public $isOpen = false;
    public $schoolStudents;
    public $name;
    public $address;
    public $telephone;
    public $email;
    public $password;

    public $students = [];

    public $selectedStudents = [];
    public $selectedTeacher;
    public $previousSelectedStudents;

    public $success = false;

    #[On('success')]
    public function changeSuccess()
    {
        $this->success = true;
    }

    public function mount()
    {
        // Initialize selected students if needed

        $this->selectedStudents = collect($this->selectedStudents);
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


    public function editSchool(Request $request)
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:schools,email,' . $this->school->id,
            'password' => 'nullable|string|min:6',
        ]);

        $this->school->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->telephone,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->school->password,
        ]);
        $current = $this->selectedStudents;
        $previous = $this->previousSelectedStudents;

        // Determine added and removed students
        $added = array_diff($current, $previous);
        $removed = array_diff($previous, $current);

        if (!empty($this->selectedTeacher)) {
            User::where('school_id', $this->school->id)->update(['role' => 'Student']);
            User::where('id', $this->selectedTeacher)->update(['role' => 'Teacher']);
        }
        // Update DB
        if (!empty($added)) {
            User::whereIn('id', $added)->update(['school_id' => $this->school->id]);
        }

        if (!empty($removed)) {
            User::whereIn('id', $removed)->update(['school_id' => null]);
        }

        // Reset teacher if deselected
        if (!in_array($this->selectedTeacher, $current)) {
            $this->selectedTeacher = null;
        }
        // Store new state
        $this->previouslySelectedStudents = $current;
        $this->loadSchool($this->school->id);
        $this->dispatch('updateSchool');
        $this->dispatch('success');

    }

    public function close()
    {
        $this->isOpen = false;
        $this->dispatch('unlock-scroll');
        $this->selectedTeacher = null;
        $this->selectedStudents = collect(); // Make sure it's a collection
    }

    public function openEdit()
    {
        $this->isEdit = true;
    }
    public function closeEdit()
    {
        $this->isEdit = false;

    }

    public function getSelectedStudentObjectsProperty()
    {
        return collect($this->selectedStudents)->isEmpty()
            ? collect()
            : User::whereIn('id', $this->selectedStudents)->get();
    }

    protected $listeners = ['openSchoolStats' => 'loadSchool'];

    public function loadSchool($id)
    {
        $this->school = School::withTrashed()->findOrFail($id);


        // Get users currently in this school
        $this->schoolStudents = User::where('school_id', $this->school->id)->get();

        // Set selected students to the IDs of those users
        $this->selectedStudents = $this->schoolStudents->pluck('id')->toArray();
        $this->previousSelectedStudents = $this->selectedStudents;
        // Show both unassigned and assigned students in the dropdown
        $this->students = User::whereNull('school_id')
            ->orWhere('school_id', $this->school->id)
            ->get();
        $this->name = $this->school->name;
        $this->address = $this->school->address;
        $this->telephone = $this->school->phone;
        $this->email = $this->school->email;

        $teacher = User::where('school_id', $this->school->id)->where('role', 'Teacher')->first();
        $this->selectedTeacher = $teacher?->id;
        $this->isOpen = true;
    }
    public function delete()
    {
        $students = User::where('school_id',$this->school->id)->get();
        foreach ($students as $student) {
            $s = User::findOrFail( $student->id );
            $s->delete();
        }
        $this->school->delete();
        $this->dispatch('updateSchool');
        $this->isOpen = false;
    }

    public function restore()
    {
        $this->school->restore();
        $students = User::withTrashed()->where('school_id',$this->school->id)->get();
        foreach ($students as $student) {
            $s = User::withTrashed()->findOrFail( $student->id );
            $s->restore();
        }
        $this->dispatch('updateSchool');
        $this->isOpen = false;

    }

    public function render()
    {

        return view('livewire.admin.schoolstats');
    }
}
