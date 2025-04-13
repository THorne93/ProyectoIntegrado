<x-dynamic-component>
    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-12">

            @foreach ($exercises as $index => $exercise)
                <a href="{{ $exercise->id }}"
                    class=" p-6 col col-4 min-w-full min-h-36 bg-white border border-gray-400 rounded-lg shadow-sm hover:bg-gray-100 
                       dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

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
                                <p> {{ \Carbon\Carbon::parse($exercise->timestamp)->diffForHumans() }}</p>
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
                </a>
            @endforeach

        </div>
    </div>
</x-dynamic-component>
