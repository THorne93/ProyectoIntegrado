<div class="h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">


    @if ($successDelete)
        <div x-data x-init="
                            toastr.success('School deleted successfully');
                            setTimeout(() => $wire.set('successDelete', false), 5000);
                        "></div>
    @endif
    @if ($successRestore)
        <div x-data x-init="
                            toastr.success('School restored successfully');
                            setTimeout(() => $wire.set('successRestore', false), 5000);
                        "></div>
    @endif

    <livewire:admin.newschool />
    <livewire:admin.schoolstats />
    <div class="text-end flex justify-items-end col col-2 mb-6 bg-white  rounded-lg ">
        <input type="text" wire:model.live="search"
            class="flex-grow rounded-r-none border border-black text-sm rounded-lg" placeholder="Search" />
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
        <button type="button" wire:click="toggleTrashed" class=" col col-1 h-auto flex items-center border-black border rounded-r-lg  hover:bg-[#FCFDAF] 
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
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-12">
            @if (!$filterTrashed)


                <button type="button" wire:click="$dispatch('openSchoolModal')"
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
                        Add New Schools
                    </h5>
                </button>
            @endif
            @foreach ($schools as $school)
                <button wire:click="$dispatch('openSchoolStats', { id: {{ $school->id }} })" class="relative col col-4 min-w-full min-h-36 h-full flex items-center bg-white border border-black rounded-lg shadow-sm hover:bg-[#FCFDAF] 
                                                   dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition">

                    <div class="flex items-center px-6 gap-8 w-full">
                        <div class="w-20 h-20 flex items-center justify-center bg-gray-300 dark:bg-gray-700 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-700 dark:text-white"
                                viewBox="0 0 448 512">
                                <path
                                    d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96 48 96C21.5 96 0 117.5 0 144L0 464c0 26.5 21.5 48 48 48l208 0 0-96c0-35.3 28.7-64 64-64s64 28.7 64 64l0 96 208 0c26.5 0 48-21.5 48-48l0-320c0-26.5-21.5-48-48-48L473.7 96 337.8 5.4zM96 192l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM96 320l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h5 title="{{ $school->name }}" class="{{ Str::length($school->address) > 32
                    ? 'text-[10px] lg:text-xs'
                    : (Str::length($school->address) > 28
                        ? 'text-sm lg:text-base'
                        : 'text-base lg:text-xl') }} tracking-tight truncate text-gray-900 dark:text-white">
                                {{ $school->name }}
                            </h5>
                            <h5 title="{{ $school->address }}" class="{{ Str::length($school->address) > 32
                    ? 'text-[10px] lg:text-xs'
                    : (Str::length($school->address) > 28
                        ? 'text-sm lg:text-base'
                        : 'text-base lg:text-xl') }} tracking-tight  text-gray-900 dark:text-white">
                                {{ $school->address }}
                            </h5>
                            <h5 title="{{ $school->email }}" class="{{ Str::length($school->email) > 32
                    ? 'text-[10px] lg:text-xs'
                    : (Str::length($school->email) > 28
                        ? 'text-sm lg:text-base'
                        : 'text-base lg:text-xl') }} tracking-tight truncate text-gray-900 dark:text-white">
                                {{ $school->email }}
                            </h5>

                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    @else
        <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="border border-black">
                    <th wire:click="order('name')" scope="col" class="px-6 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'name'])>Name</p>
                            @if ($column == 'name')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>


                    <th wire:click="order('address')" scope="col" class="px-6 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'address'])>Address</p>
                            @if ($column == 'address')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>
                    <th wire:click="order('email')" scope="col" class="px-6 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'email'])>Email</p>
                            @if ($column == 'email')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>
                    <th wire:click="order('phone')" scope="col" class="px-6 py-3 cursor-pointer">
                        <div class="flex items-center gap-1">
                            <p @class(['underline text-black' => $column == 'phone'])>Tlf no.</p>
                            @if ($column == 'phone')
                                @if ($orderDirection == 'desc')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr wire:click="$dispatch('openSchoolStats', { id: {{ $school->id }} })"
                        class="bg-white border dark:bg-gray-800 dark:border-gray-700 cursor-pointer border-gray-400 hover:bg-[#FCFDAF] dark:hover:bg-gray-600">

                        <td class="px-6 py-4">
                            {{ $school->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $school->address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $school->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $school->phone }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>