<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use App\Models\School;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $surname = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $school = false;
    public bool $newSchool = false;
    public $schools;
    public string $school_name = '';
    public string $address = '';
    public string $school_email = '';
    public string $school_password = '';
    public string $confirm_school_password = '';
    public $school_select;

    public function mount()
    {
        $this->schools = School::all();
    }

    public function isTeacher()
    {
        $this->school = !$this->school;
    }

    public function isNewSchool()
    {
        $this->newSchool = !$this->newSchool;
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // Base validation for all users
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Extra validation if user is a teacher
        if ($this->school) {
            if ($this->newSchool) {
                // New school registration
                $this->validate([
                    'school_name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string'],
                    'school_email' => ['required', 'email'],
                    'school_password' => ['required', 'string', 'confirmed'],
                ]);

                // Create the new school
                $school = School::create([
                    'name' => $this->school_name,
                    'address' => $this->address,
                    'email' => $this->school_email,
                    'password' => Hash::make($this->school_password),
                ]);
            } else {
                // Existing school
                $this->validate([
                    'school_select' => ['required', 'exists:schools,id'],
                    'school_password' => ['required', 'string'],
                ]);

                $school = School::find($this->school_select);

                if (!Hash::check($this->school_password, $school->password)) {
                    $this->addError('school_password', 'Invalid school code.');
                    return;
                }
            }

            // Attach the school ID to the user
            $validated['school_id'] = $school->id;
            $validated['role'] = 'Teacher';
        } else {
            $validated['role'] = 'Student'; // or whatever role you're using for non-teachers
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit.prevent="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('First name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <div>
                <x-input-label for="surname" :value="__('Last name(s)')" />
                <x-text-input wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname"
                    required autofocus autocomplete="surname" />
                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="mt-4">

            <input type="checkbox" wire:click='isTeacher' /><x-input-label class="inline mr-10" :value="__('I am a teacher')" />
            @if ($school)
                <input type="checkbox" class="ml-10" wire:click='isNewSchool' /><x-input-label class="inline"
                    :value="__('New school')" />
            @endif
        </div>

        @if ($school)
            @if (!$newSchool)
                <div class="mt-4 flex items-center space-x-4">
                    <div>
                        <x-input-label for="school_select" :value="__('Choose your school')" />
                        <select class="rounded" wire:model='school_select' id="school_select">
                            @foreach ($schools as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="school_password" :value="__('Enter your school\'s code')" />
                        <x-text-input wire:model="school_password" id="school_password" class="block w-full"
                            type="password" name="school_password" required autocomplete="school-password" />
                        <x-input-error :messages="$errors->get('school_password')" class="mt-2" />
                    </div>
                </div>
            @else
                <div>
                    <x-input-label for="school_name" :value="__('School name')" />
                    <x-text-input wire:model="school_name" id="school_name" class="block mt-1 w-full" type="text"
                        name="school_name" required autofocus autocomplete="school_name" />
                    <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text"
                        name="address" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="school_email" :value="__('School contact email')" />
                    <x-text-input wire:model="school_email" id="school_email" class="block mt-1 w-full" type="text"
                        name="school_email" required autofocus autocomplete="school_email" />
                    <x-input-error :messages="$errors->get('school_email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="school_password" :value="__('Enter your school\'s code')" />
                    <x-text-input wire:model="school_password" id="school_password" class="block w-full" type="password"
                        name="school_password" required autocomplete="school-password" />
                    <x-input-error :messages="$errors->get('school_password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="confirm_school_password" :value="__('Confirm your school\'s code')" />
                    <x-text-input wire:model="confirm_school_password" id="confirm_school_password"
                        class="block w-full" type="password" name="confirm_school_password" required
                        autocomplete="confirm_school_password" />
                    <x-input-error :messages="$errors->get('confirm_school_password')" class="mt-2" />
                </div>
            @endif

        @endif



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
