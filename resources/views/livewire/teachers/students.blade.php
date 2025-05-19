<div class="h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">

    <livewire:teachers.newstudents />
    <livewire:teachers.studentstats />
    @if ($successDelete)
        <div x-data x-init="toastr.success('Student deleted successfully');
        setTimeout(() => $wire.set('successDelete', false), 5000);"></div>
    @endif
    @if ($successRestore)
        <div x-data x-init="toastr.success('Student restored successfully');
        setTimeout(() => $wire.set('successRestore', false), 5000);"></div>
    @endif
    <div class="text-end flex justify-items-end col col-2 mb-6 bg-white  rounded-lg">
        <input type="text" wire:model.live="search" class="flex-grow rounded-r-none text-sm rounded-lg border-black"
            placeholder="Search by name, surname and email..." />
        @if ($view == 'table')
            <button type="button" wire:click="toggleCards"
                class="w-38 h-auto flex items-center justify-center text-center border-l-none border border-black bg-white  hover:bg-[#FCFDAF] transition px-6">
                Change view ⇄
            </button>
        @else
            <button type="button" wire:click="toggleTable"
                class="w-38 h-auto flex items-center justify-center text-center border-l-none border border-black bg-white  hover:bg-[#FCFDAF] transition px-6">
                Change view ⇄
            </button>
        @endif
        <button type="button" wire:click="toggleTrashed"
            class=" col col-1 h-auto flex items-center border-black border rounded-r-lg  hover:bg-[#FCFDAF] 
               transition px-6 gap-8">{{ !$filterTrashed ? 'Show deleted' : 'Show active' }}</button>
    </div>
    <div class="mb-4 flex justify-between items-center">
        <div class="text-start">
            {{ ucfirst($view) }} view
        </div>
        @if ($view !== 'cards')
            @if (!$filterTrashed)
                <div class="text-end">
                    <button type="button" wire:click="$dispatch('openModal')"
                        class="h-8 w-8 flex items-center text-xl justify-center bg-white border border-black text-black rounded-full hover:bg-[#FCFDAF] transition">
                       +
                    </button>

                </div>
            @endif
        @endif
    </div>

    @if ($view === 'cards')
        <div class="grid grid-cols-2 lg:grid-cols-3 3xl:grid-cols-4  gap-12">
            @if (!$filterTrashed)
                <button type="button" wire:click="$dispatch('openModal')"
                    class="relative col col-4 min-w-full min-h-36 h-full flex items-center bg-white border border-black rounded-lg shadow-sm hover:bg-[#FCFDAF]
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
            @endif
            @foreach ($students as $student)
                <button
                    @if (!$student->email_verified_at == null) wire:click="$dispatch('openStats', { id: {{ $student->id }} })" @endif
                    class="relative col col-4 min-w-full min-h-36 h-full flex items-center  bg-white border border-gray-950 rounded-lg shadow-sm hover:bg-[#FCFDAF] transition">
                    <div class="flex items-center px-6 gap-8 w-full">
                        <div
                            class="w-20 h-20 flex items-center justify-center bg-gray-300 dark:bg-gray-700 rounded-full">
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
                                @if (!$student->email_verified_at == null)
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
                                                                            : (Str::length($student->email) > 25
                                                                                ? 'text-sm lg:text-base'
                                                                                : 'text-base lg:text-xl') }}">
                                {{ $student->email }}
                            </h5>


                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    @else
        <table class="w-full text-sm text-left rtl:text-right rounded-lg  text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="border border-black">
                    <th wire:click="order('name')" scope="col" class="px-6 py-3 w-1/4 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'name'])>Name</p>
                            @if ($column == 'name')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>


                    <th wire:click="order('surname')" scope="col" class="px-6 w-1/4 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'surname'])>Surname</p>
                            @if ($column == 'surname')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>
                    <th wire:click="order('email')" scope="col" class="px-6 w-2/4 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'email'])>Email</p>
                            @if ($column == 'email')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>


                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr wire:click="$dispatch('openUserStats', { id: {{ $student->id }} })"
                        class="bg-white border text-gray-800 dark:bg-gray-800 dark:border-gray-700 cursor-pointer border-gray-400 hover:bg-[#FCFDAF] dark:hover:bg-gray-600">

                        <td class="px-6 py-4">
                            {{ $student->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student->surname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student->email }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
