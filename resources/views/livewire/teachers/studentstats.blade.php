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
            <div class="flex items-center px-6 gap-8 w-full">
                <div class="w-20 h-20 flex items-center justify-center bg-gray-300 dark:bg-gray-700 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-700 dark:text-white"
                        viewBox="0 0 448 512">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                </div>
                @if ($student)
                    <div class="flex-1">
                        <div class="flex gap-8"><h5 title="{{ $student->name . ' ' . $student->surname }}"
                            class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            {{ $student->name . ' ' . $student->surname }}
                        </h5><a wire:click="goToStatistics({{ $student->id }})"
                    class="p-2 cursor-pointer rounded-md bg-white border border-gray-400 hover:bg-yellow-100 dark:bg-gray-700 dark:hover:bg-gray-600 transition inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" viewBox="0 0 448 512"
                        fill="currentColor">
                        <path
                            d="M160 80c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 352c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-352zM0 272c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48L0 272zM368 96l32 0c26.5 0 48 21.5 48 48l0 288c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48z" />
                    </svg>
                </a></div>
                        
                        <h5 class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            Last active:
                            @if (\Carbon\Carbon::parse($student->date)->isFuture())
                                Less than an hour ago
                            @else
                                {{ \Carbon\Carbon::parse($student->date)->diffForHumans() }}
                            @endif
                        </h5>
                        <h5 title="{{ $student->email }}"
                            class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            {{ $student->email }}
                        </h5>
                    </div>
                @endif
            </div>

            @if ($isEdit)
                @if ($success)
                    <div x-data="{ show: true }" x-init="setTimeout(() => {
                        show = false;
                        $wire.set('success', false);
                    }, 5000)" x-show="show" x-transition.duration.500ms
                        class="mb-6">
                        <div
                            class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg shadow flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-base font-medium">
                                User edited successfully
                            </span>
                        </div>
                    </div>
                @endif
                <form wire:submit="editStudent" class="mt-2">
                    <!-- Name -->
                    <div>
                        <x-input-label for="f_name" :value="__('First name')" />
                        <x-text-input wire:model="f_name" id="f_name" class="block mt-1 w-full" type="text"
                            value="{{ $student->name }}" name="f_name" required autofocus autocomplete="f_name" />
                        <x-input-error :messages="$errors->get('f_name')" class="mt-2" />
                    </div>
                    <!-- Name -->
                    <div class="mt-4">
                        <div>
                            <x-input-label for="l_name" :value="__('Last name(s)')" />
                            <x-text-input wire:model="l_name" id="l_name" class="block mt-1 w-full" type="text"
                                value="{{ $student->surname }}" name="l_name" required autofocus
                                autocomplete="l_name" />
                            <x-input-error :messages="$errors->get('l_name')" class="mt-2" />
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                            name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input wire:model="password_confirmation" id="password_confirmation"
                            class="block mt-1 w-full" type="password" name="password_confirmation" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <input type="checkbox" wire:model="is_teacher" /><x-input-label class="inline mr-10"
                            :value="__('Is teacher')" />

                    </div>
                </form>
            @else
                <div class="my-2 text-center">Average Results</div>
                <div class="flex justify-evenly gap-4">
                    <p class="text-gray-700">Part 1: {{ $part1percent }}%</p>
                    <p class="text-gray-700">Part 2: {{ $part2percent }}%</p>
                    <p class="text-gray-700">Part 3: {{ $part3percent }}%</p>
                    <p class="text-gray-700">Part 4: {{ $part4percent }}%</p>
                </div>
                @if ($latestScores)
                    <div class="my-2 text-center">Latest Results</div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-2">
                                        Part
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Exercise
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Score
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestScores as $result)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <td class="px-6 py-1 ">
                                            {{ $result->part }}
                                        </td>
                                        <td class="px-6 py-1">
                                            {{ $result->title }}
                                        </td>
                                        <td class="px-6 py-1">
                                            {{ $result->timestamp }}
                                        </td>
                                        <td class="px-6 py-1">
                                            {{ $result->score }} / @if ($result->part === '4')
                                                12
                                            @else
                                                8
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
            @endif
            <div class="flex justify-center gap-8 mt-2">
                @if ($isEdit)
                    <button wire:click='closeEdit'
                        class="flex-1 px-4 py-2 bg-white  border border-black rounded hover:bg-red-400 text-black transition-colors">Cancel</button>
                    <button wire:click='editStudent'
                        class="flex-1 px-4 py-2 bg-white border border-black rounded hover:bg-green-400 text-black transition-colors">Confirm</button>
                @else
                    @if ($student && $student->trashed())
                        <button wire:click='restore'
                            class="flex-1 px-4 py-2 bg-white  border border-black rounded hover:bg-blue-400 text-black transition-colors">Restore</button>
                    @else
                        <button wire:click='openEdit'
                            class="flex-1 px-4 py-2 bg-white border border-black rounded hover:bg-green-400 text-black transition-colors">Edit</button>

                        <button wire:click='delete'
                            class="flex-1 px-4 py-2 bg-white  border border-black rounded hover:bg-red-400 text-black transition-colors">Delete</button>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
