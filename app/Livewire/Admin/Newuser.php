<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;
use App\Mail\LoginLinkEmail;
use Mail;

class Newuser extends ModalComponent
{

    public $isOpen = false;
    public $name;
    public $surname;
    public $email;
    public $schools;
    public $selectedSchool = '';
    public $is_teacher = false;

    public $success = false;

    #[On('success')]
    public function changeSuccess()
    {
        $this->success = true;
    }
    public function open()
    {
        $this->reset(['name', 'email']);
        $this->isOpen = true;
        $this->dispatch('lock-scroll');
    }

    public function close()
    {
        $this->isOpen = false;
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->selectedSchool = '';
        $this->dispatch('unlock-scroll');
    }

    public function updatedSelectedSchool($value)
    {
        if (!is_numeric($value)) {
            $this->is_teacher = false;
        }
    }
    public function submit()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $data = $validated;

        if (!empty($this->selectedSchool)) {
            $data['school_id'] = $this->selectedSchool;
        }

        $data['password'] = Hash::make('1234');

        $user = User::create($data);
        Mail::to($user->email)->send(new LoginLinkEmail($user));

        $this->dispatch('success');

        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->selectedSchool = '';
    }


    protected $listeners = ['openModal' => 'open'];
    public function render()
    {
        $this->schools = School::all();
        return view('livewire.admin.newuser');
    }
}
