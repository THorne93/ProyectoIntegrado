<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="grid grid-cols-2 lg:grid-cols-3  3xl:grid-cols-4 gap-12">

            @foreach ($exercises as $index => $exercise)
                    @php
                        $isActive = Auth::user()->set_exercise == $exercise->id;
                    @endphp
                    <button x-data @click="$dispatch('openLauncher', { id: {{ $exercise->id }} })"
                        wire:key="exercise-{{ $exercise->id }}"
                        class="p-6 col col-4 min-w-full min-h-36 border border-black rounded-lg shadow-sm transition 
                {{ $isActive ? 'bg-white shadow-lg  hover:bg-[#FCFDAF] animate-customPulse ' : 'bg-white hover:bg-[#FCFDAF] ' }}">
                        <div class="flex min-w-full gap-4 mb-4 border-b border-gray-300 -mx-6 px-6 pb-4">
                            <h5 class="text-base lg:text-xl font-bold tracking-tight pb-1 text-gray-400 dark:text-white">
                                {{ $index + 1 }}
                            </h5>
                            <h5 title="{{ $exercise->title }}"
                                class="ml-2 text-xl lg:text-2xl font-bold tracking-tight truncate text-gray-900 dark:text-white">
                                {{ $exercise->title }}
                            </h5>
                        </div>

                        <div class="flex-grow flex items-center justify-center text-center">
                            @if ($exercise->timestamp)
                                <div class="w-full border-r border-gray-200">
                                    <p>Last done</p>
                                    <p>
                                        @if (\Carbon\Carbon::parse($exercise->timestamp)->isFuture())
                                            Less than an hour ago
                                        @else
                                            {{ \Carbon\Carbon::parse($exercise->timestamp)->diffForHumans() }}
                                        @endif
                                    </p>
                                </div>
                                <div class="w-full">
                                    <p>Last score</p>
                                    <p>{{ $exercise->score }} / @if ($exercise->part == 4)
                                        12
                                    @else
                                            8
                                        @endif
                                    </p>
                                </div>
                            @else
                                <div class="w-full">You haven't done this exercise yet. Try it now!</div>
                            @endif
                        </div>
                    </button>
            @endforeach

        </div>
    </div>
    <livewire:exercise.launcher />

</x-app-layout>