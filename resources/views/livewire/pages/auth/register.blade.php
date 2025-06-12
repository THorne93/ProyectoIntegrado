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
    public bool $hasSchool = false;
    public bool $newSchool = false;
    public $schools;
    public string $school_name = '';
    public string $address = '';
    public string $school_email = '';
    public string $school_phone = '';
    public string $school_password = '';
    public string $new_school_password = '';
    public string $new_school_password_confirmation = '';
    public $school_select;

    public function mount()
    {
        $this->schools = School::all();
    }

    public function register(): void
    {
        if ($this->school && $this->hasSchool) {
            $this->hasSchool = false;
        }
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($this->school) {
            if ($this->newSchool) {
                $this->validate([
                    'school_name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string'],
                    'school_phone' => ['required', 'string', 'max:255'],
                    'school_email' => ['required', 'email'],
                    'new_school_password' => ['required', 'string', 'confirmed'],
                ]);

                $school = School::create([
                    'name' => $this->school_name,
                    'address' => $this->address,
                    'email' => $this->school_email,
                    'phone' => $this->school_phone,
                    'password' => Hash::make($this->new_school_password),
                ]);
            } else {
                $this->validate([
                    'school_select' => ['required', 'exists:schools,id'],
                    'school_password' => ['required', 'string'],
                ]);

                $school = School::find($this->school_select);

                if (!Hash::check($this->school_password, $school->password)) {
                    $this->addError('school_code', 'Invalid school code.');
                    return;
                }
            }

            $validated['school_id'] = $school->id;
            $validated['role'] = 'Teacher';
        } else {
            $validated['role'] = 'Student';
        }
        if ($this->hasSchool) {
            $this->validate([
                'school_select' => ['required', 'exists:schools,id'],
                'school_password' => ['required', 'string'],
            ]);

            $school = School::find($this->school_select);

            if (!Hash::check($this->school_password, $school->password)) {
                $this->addError('school_code', 'Invalid school code.');
                return;
            }

            $validated['school_id'] = $school->id;
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div>
    <form wire:submit.prevent="register">
        <div>
            <x-input-label for="name" :value="__('First name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="surname" :value="__('Last name(s)')" />
            <x-text-input wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname"
                required autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <input type="checkbox" wire:model.live="school" />
            <x-input-label class="inline mr-10" :value="__('I am a teacher')" />

                <input type="checkbox" class="ml-10" wire:model.live="hasSchool" />
                <x-input-label class="inline mr-10" :value="__('Join school')" />
        </div>
        @if ($hasSchool && !$school)
            <div class="mt-4">
                <x-input-label for="school_select" :value="__('Choose your school')" />
                <select class="rounded w-full" wire:model="school_select" id="school_select">
                    <option value="">-- Select a school --</option>
                    @foreach ($schools as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('school_select')" class="mt-2" />
                <div class="mt-4">
                    <x-input-label for="school_password" :value="__('Enter your school\'s code')" />
                    <x-text-input wire:model="school_password" id="school_password" class="block w-full" type="password"
                        name="school_password" required />
                    <x-input-error :messages="$errors->get('school_password')" class="mt-2" />
                </div>
            </div>
        @endif
        @if ($school)
            <div class="mt-4">
                <x-input-label for="school_select" :value="__('Choose your school')" />
                <select class="rounded w-full" wire:model="school_select" id="school_select">
                    <option value="">-- Select a school --</option>
                    @foreach ($schools as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('school_select')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="school_password" :value="__('Enter your school\'s code')" />
                <x-text-input wire:model="school_password" id="school_password" class="block w-full" type="password"
                    name="school_password" required />
                <x-input-error :messages="$errors->get('school_password')" class="mt-2" />
            </div>

        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>
            <div wire:loading>
                <div style="display: inline-flex; align-items: center; gap: 5px;">
                    <img width="16" height="16" src="https://media.tenor.com/G7LfW0O5qb8AAAAi/loading-gif.gif"
                        alt="">
                </div>
            </div>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</div>
