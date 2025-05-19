<?php

use App\Livewire\Actions\Logout;
use App\Models\School;
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

<nav x-data="{ open: false }" class="w-full bg-white navbarBorder">
    <div class="">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                @if (Auth::user())
                <button id="toggle-sidebar" class="border-y border-e border-gray-400 px-1">
                    ←
                </button>
                @endif
            </div>
            @if (Auth::user())



                <div class="flex items-end justify-end px-3 py-3 lg:px-5 lg:pl-3">

                    <span class="self-end text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Good
                        @if (now()->hour < 12)
                            morning,
                        @elseif(now()->hour < 18)
                            afternoon,
                        @else
                            evening,
                        @endif
                        {{ Auth::user()->name . ' ' . Auth::user()->surname }}
                        @if (Auth::user()->school_id != null)
                            - <span class="text-blue-800">{{ School::findOrFail(Auth::user()->school_id)->name }}</span>
                        @endif
                    </span>
                </div>
            @else
                <div class="flex items-end justify-end px-3 py-4 sm:text-xl font-semibold text-xl lg:px-5 lg:pl-3">
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3  text-white ring-1 ring-transparent transition  focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3  text-white ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</nav>
