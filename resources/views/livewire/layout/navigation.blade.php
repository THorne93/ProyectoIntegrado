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

<nav x-data="{ open: false }" class="w-full navbarbg navbarBorder">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"><img style="height: 36px;" src="/storage/img/logo.png"></span>

            </div>
            @if (Auth::user())


                <div class="flex items-end justify-end ">

                    <span class="self-end text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Good
                        @if (now()->hour < 12) morning, @elseif(now()->hour < 18) afternoon, @else evening, @endif
                        {{ Auth::user()->name . " " . Auth::user()->surname }}
                        @if (Auth::user()->school_id != null)
                            - <span class="text-blue-800">{{ (School::findOrFail(Auth::user()->school_id))->name }}</span>
                        @endif
                    </span>
                </div>
            @else
                <div class="flex items-end justify-end ">
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</nav>