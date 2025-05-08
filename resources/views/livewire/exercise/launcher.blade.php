<div x-data="{ open: @entangle('isOpen').live }">
    <!-- Overlay (Prevents clicking on background) -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" x-transition.opacity @click="open = false">
    </div>

    <!-- Modal (Interactive) -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-transition>
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
            <button type="button" wire:click="close"
                class="absolute top-2 right-2 p-2 rounded-full bg-transparent hover:bg-red-500 transition duration-200"
                aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700 hover:text-white"
                    viewBox="0 0 24 24">
                    <path fill="currentColor" d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            @if ($titleEx)
                <div class="flex justify-center mb-4">
                    <a href="{{ route('exercises.play', ['part' => $titleEx->part, 'id' => $titleEx->id]) }}"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Start Now
                    </a>
                </div>
                @if ((count($results) > 0))
                    <div class="my-2 text-center">Latest results for {{ $titleEx->title }}</div>

                @endif
            @endif
            @if ((count($results) > 0))
                <div class="p-4">
                    <table class="w-full table-auto border-collapse border-black">
                        <thead>
                            <tr class="bg-gray-200 text-center">
                                <th class="px-4 p-2 w-1/2">Date</th>
                                <th class="px-4 p-2 w-1/2">Score</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- Scrollable container for the table body -->
                    <div class="max-h-60 overflow-y-auto scrollBarThin">
                        <table class="w-full table-auto border border-gray-200">
                            <tbody>
                                @foreach ($results as $result)
                                    <tr
                                        class=" odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <td class="text-center w-1/2 px-4 p-2">
                                            {{ \Carbon\Carbon::parse($result->timestamp)->format('d-m-Y') }}
                                        </td>
                                        <td class="text-center w-1/2 px-4 p-2">{{ $result->score }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="">
                    <p class="text-center">You have no results yet!</p>
                </div>
            @endif
        </div>
    </div>
</div>