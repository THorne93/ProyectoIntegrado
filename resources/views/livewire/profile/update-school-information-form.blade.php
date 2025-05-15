<?php

use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $address = '';
    public string $email = '';
    public string $phone = '';


    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $school = School::find(Auth::user()->school_id);
        $this->name = $school->name;
        $this->address = $school->address;
        $this->email = $school->email;
        $this->phone = $school->phone;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $school = School::find(Auth::user()->school_id);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(School::class)->ignore($school->id)],
        ]);

        $school->fill($validated);

        if ($school->isDirty('email')) {
            $school->email_verified_at = null;
        }

        $school->save();
        $this->dispatchBrowserEvent('profile-updated', ['name' => $school->name]);
        $this->dispatch('profile-updated', name: $school->name);
    }

}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('School Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your schools's profile information and contact details.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="address" id="address" name="address" type="text" class="mt-1 block w-full"
                required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <div>
            <x-input-label for="phone" :value="__('Contact number')" />
            <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
    <script>
        window.addEventListener('profile-updated', event => {
            console.log('Profile updated with new school name:', event.detail.name);
            location.reload();
        });
    </script>
</section>