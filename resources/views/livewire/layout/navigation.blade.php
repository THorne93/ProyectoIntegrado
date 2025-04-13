<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="w-full navbarbg navbarBorder">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">B2 Exam
                    Lab or something</span>
            </div>
            <div class="flex items-end justify-end ">
                    <span class="self-end text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Good @if (now()->hour < 12) morning, @elseif(now()->hour < 18) afternoon, @else evening, @endif {{ Auth::user()->name." ".Auth::user()->surname }}</span>
            </div>

        </div>
    </div>
</nav>
