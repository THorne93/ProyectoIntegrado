<?php
namespace App\Livewire\Teachers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;
use App\Mail\LoginLinkEmail;
use Mail;
class Newstudents extends ModalComponent
{

    public $isOpen = false;
    public $name;
    public $surname;
    public $email;

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
        $this->dispatch('unlock-scroll');
    }

    public function submit()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);
        $user = User::create(array_merge(
            $validated,
            [
                'password' => Hash::make('1234'),
                'school_id' => Auth::user()->school->id
            ]
        ));
        Mail::to($user->email)->send(new LoginLinkEmail($user));
        $this->dispatch('newUser');
        $this->dispatch('success');
        $this->name = '';
        $this->surname = '';
        $this->email = '';

    }

    protected $listeners = ['openModal' => 'open'];
    public function render()
    {
        
        return view('livewire.teachers.newstudents');
    }
}
