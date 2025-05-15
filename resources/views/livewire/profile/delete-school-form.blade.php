<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\School;
use App\Models\User;

new class extends Component {
    public bool $confirmingUserDeletion = false;

    public string $password = '';

    public function open()
    {
        $this->confirmingUserDeletion = true;
    }
    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $school = School::find(Auth::user()->school_id);
        $students = User::where('school_id', $school->id)
            ->where('id', '!=', Auth::user()->id)->get();
        foreach ($students as $student) {
            $student->delete();
        }
        $school->delete();
        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete School') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('This will not just delete the school, but also all of the students within it, so use with caution!') }}
        </p>
    </header>

    <x-danger-button wire:click="open">
        {{ __('Delete School') }}
    </x-danger-button>

    @if ($confirmingUserDeletion)
        <x-danger-button class="ms-3" wire:click="deleteUser">
            {{ __('Confirm') }}
        </x-danger-button>
    @endif

</section>