<div x-cloak x-data="{ open: @entangle('isOpen').live }">
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
            @if (Auth::user()->role == 'Student')
                @if ($titleEx)
                    <div class="flex justify-center mb-4">
                        <a href="{{ route('exercises.play', ['part' => $titleEx->part, 'id' => $titleEx->id]) }}"
                            class="text-gray-900 bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
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
            @else
                @if ($titleEx)
                    <div class="flex justify-center mb-4">
                        <h5 title="{{ $titleEx->title }}"
                            class="ml-2 text-xl lg:text-2xl font-bold tracking-tight truncate text-gray-900 dark:text-white">
                            {{ $titleEx->title }}
                        </h5>
                    </div>
                    <div class="flex justify-center p-4">
                        <a href="{{ route('exercises.play', ['part' => $titleEx->part, 'id' => $titleEx->id]) }}"
                            class="w-1/2 text-gray-900 text-center bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Test
                        </a>
                        <button wire:click="triggerConfirm"
                            class=" w-1/2 text-gray-900 bg-white border border-black focus:outline-none hover:bg-[#FCFDAF] focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            @if ($exerciseId == Auth::user()->set_exercise)
                                Unset
                            @else
                                Set
                            @endif
                        </button>
                    </div>
                @endif
                @if ((count($results) > 0))
                    <div class="p-4">
                        <table class="w-full table-auto border-collapse border-black">
                            <thead>
                                <tr class="bg-gray-200 text-center">
                                    <th class=" p-2 me-2  w-2/6">Student</th>
                                    <th class=" p-2 me-2  w-1/6">Score</th>
                                    <th class=" p-2 me-2  w-1/6">Time (m:s)</th>
                                    <th class="p-2  me-2 w-3/6">Date</th>
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
                                            <td class="text-center w-2/6  p-2">{{ $result->name }} {{ $result->surname }}</td>
                                            <td class="text-center w-1/6  p-2">{{ $result->score }}</td>
                                            <td class="text-center w-1/6  p-2">{{ str_pad(floor($result->time_spent / 60), 2, '0', STR_PAD_LEFT) }}:{{ str_pad($result->time_spent % 60, 2, '0', STR_PAD_LEFT) }}</td>
                                            <td class="text-center w-2/6  p-2">
                                                {{ \Carbon\Carbon::parse($result->timestamp)->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="">
                        <p class="text-center">No one has done this exercise yet!</p>
                    </div>
                @endif
                @if ($toDoStudents)
                                        <h5 
                            class="ml-2 text-xl text-center font-bold tracking-tight truncate text-gray-900 dark:text-white">
                            Not done by:
                            <div class="flex flex-wrap text-center gap-2 p-2 my-2">
                                @foreach ($toDoStudents as $student)
                            <span class="bg-[#DBA159] rounded-full text-sm mx-1 p-2">{{ $student->name.' '.$student->surname }}</span>
                            @endforeach
</div>
                        </h5>
                @endif
            @endif

        </div>
    </div>
        <div x-cloak x-data="{ confirm: @entangle('confirmLaunch').live }" x-show="confirm"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg max-w-md w-full space-y-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Confirm Exercise</h2>
                <p class="text-gray-700 dark:text-gray-300">Are you sure you want set this exercise?</p>
                <div class="flex justify-end gap-4">
                    <button wire:click='triggerConfirm'
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button wire:click='setExercise'
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm">
                        Yes, Submit
                    </button>
                </div>
            </div>
        </div>
</div>