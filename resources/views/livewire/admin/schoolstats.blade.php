<div x-cloak x-data="{ open: @entangle('isOpen').live }">
    <!-- Overlay (Prevents clicking on background) -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50  z-40" x-transition.opacity @click="open = false">
    </div>

    <!-- Modal (Interactive) -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-transition>
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative max-h-[80vh] overflow-y-auto scrollBarThin">

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
                @if ($school)
                    <div class="flex-1">
                        <h5 title="{{ $school->name }}"
                            class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            {{ $school->name }}
                        </h5>
                        <h5 class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            Number of students:
                            {{ count($school->students) }}
                        </h5>
                        <h5 title="{{ $school->email }}"
                            class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                            {{ $school->email }}
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
                                School edited successfully
                            </span>
                        </div>
                    </div>
                @endif
                <form wire:submit="register" class="mt-2 overflow-y-auto scrollBarThin">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text"
                            value="{{ $school->name }}" name="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email -->
                    <div class="mt-4">
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input wire:model="address" id="address" class="block mt-1 w-full" type="text"
                                value="{{ $school->address }}" name="address" required autofocus
                                autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <div>
                            <x-input-label for="telephone" :value="__('Telephone Number')" />
                            <x-text-input wire:model="telephone" id="telephone" class="block mt-1 w-full" type="text"
                                value="{{ $school->phone }}" name="telephone" required autofocus
                                autocomplete="telephone" />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="text"
                                value="{{ $school->email }}" name="email" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Code -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('New Code')" />
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                            name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-select label="Select Students" wire:model.live.debounce.500ms="selectedStudents" multiselect
                            option-label="name" option-value="id" :options="$students
                                ->map(
                                    fn($s) => [
                                        'id' => $s->id,
                                        'name' => $s->name . ' ' . $s->surname . ' - ' . $s->email,
                                    ],
                                )
                                ->toArray()"
                            class="text-black rounded-md shadow-sm border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 dark:bg-white dark:text-black"
                            option-class="hover:bg-primary-100 hover:text-black"
                            option-selected-class="bg-primary-200 text-black font-semibold"
                            option-empty-class="text-gray-400 italic px-2 py-1" />
                    </div>
                    <div class="mt-4">
                        @php
                            // Fetch students by their IDs
                            $studentsData = \App\Models\User::whereIn('id', $selectedStudents)->get();
                        @endphp

                        <x-select label="Select Teacher" wire:model="selectedTeacher" option-label="name"
                            option-value="id" :options="collect($studentsData)
                                ->map(
                                    fn($s) => [
                                        'id' => $s->id,
                                        'name' => $s->name . ' ' . $s->surname . ' - ' . $s->email,
                                    ],
                                )
                                ->toArray()"
                            class="text-black rounded-md shadow-sm border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 dark:bg-white dark:text-black"
                            option-class="hover:bg-primary-100 hover:text-black"
                            option-selected-class="bg-primary-200 text-black font-semibold"
                            option-empty-class="text-gray-400 italic px-2 py-1" />
                    </div>




                </form>


            @endif
            <div class="flex justify-center gap-8 mt-2">
                @if ($isEdit)
                    <button wire:click='closeEdit'
                        class="flex-1 px-4 py-2 bg-gray-300  border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">Cancel</button>
                    <button wire:click='editSchool'
                        class="flex-1 px-4 py-2 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">Confirm</button>
                @else
                    <button wire:click='openEdit'
                        class="flex-1 px-4 py-2 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">Edit</button>
                    <button
                        class="flex-1 px-4 py-2 bg-gray-300  border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">Delete</button>
                @endif

            </div>
        </div>
    </div>
</div>
