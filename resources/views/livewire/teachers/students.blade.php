<div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">



    <livewire:teachers.newstudents />
    <livewire:teachers.studentstats />



    <div class="grid grid-cols-2 lg:grid-cols-3 gap-12">

        <button type="button" wire:click="$dispatch('openModal')"
            class="relative col col-4 min-w-full min-h-36 h-full flex items-center bg-white border border-gray-400 rounded-lg shadow-sm hover:bg-gray-100 
               dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition px-6 gap-8">
            <div class="w-20 h-20 flex items-center justify-center bg-gray-300 dark:bg-gray-700 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-700 dark:text-white"
                    viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                </svg>
            </div>
            <h5 class="text-xl font-medium tracking-tight text-gray-900 dark:text-white">
                Add New Users
            </h5>
        </button>
        @foreach ($students as $student)
            <button
                @if ($student->account_verified == 1) wire:click="$dispatch('openStats', { id: {{ $student->id }} })" @endif
                class="relative col col-4 min-w-full min-h-36 h-full flex items-center bg-white border border-gray-400 rounded-lg shadow-sm hover:bg-gray-100 
               dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition">

                <div class="flex items-center px-6 gap-8 w-full">
                    <div class="w-20 h-20 flex items-center justify-center bg-gray-300 dark:bg-gray-700 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-700 dark:text-white"
                            viewBox="0 0 448 512">
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h5 title="{{ $student->name . ' ' . $student->surname }}"
                            class="tracking-tight truncate text-gray-900 dark:text-white {{ Str::length($student->name . ' ' . $student->surname) > 28 ? 'text-sm lg:text-base' : 'text-base lg:text-xl' }}">
                            {{ $student->name . ' ' . $student->surname }}
                        </h5>

                        <h5
                            class="tracking-tight truncate text-gray-900 dark:text-white {{ Str::length($student->date) > 28 ? 'text-sm lg:text-base' : 'text-base lg:text-xl' }}">
                            @if ($student->account_verified == 1)
                                @if (\Carbon\Carbon::parse($student->date)->isFuture())
                                    Less than an hour ago
                                @else
                                    {{ \Carbon\Carbon::parse($student->date)->diffForHumans() }}
                                @endif
                            @else
                                <p class="text-red-600">USER NOT VERIFIED</p>
                            @endif
                        </h5>

                        <h5 title="{{ $student->email }}"
                            class="tracking-tight truncate text-gray-900 dark:text-white
                                {{ Str::length($student->email) > 32
                                    ? 'text-[10px] lg:text-xs'
                                    : (Str::length($student->email) > 28
                                        ? 'text-sm lg:text-base'
                                        : 'text-base lg:text-xl') }}">
                            {{ $student->email }}
                        </h5>


                    </div>
                </div>
            </button>
        @endforeach
    </div>
</div>
