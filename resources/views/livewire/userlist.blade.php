<div x-cloak x-data="{ open: @entangle('isOpen').live }">
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" x-transition.opacity @click="open = false">
    </div>

    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-transition>
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative flex flex-col h-[70vh]">
            <button type="button" wire:click="close"
                class="absolute top-2 right-2 p-2 rounded-full bg-transparent hover:bg-red-500 transition duration-200"
                aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700 hover:text-white"
                    viewBox="0 0 24 24">
                    <path fill="currentColor" d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="flex flex-col items-center justify-center">
                <div class="flex flex-row w-4/5  border border-black mb-2 rounded-lg">
                    <button class="w-1/2 rounded-s-lg
                    @if($view == 'offline') bg-white hover:bg-[#FCFDAF]
                     @else bg-[#DBA159] 
                     @endif
                     text-black py-2 " wire:click="toggleOnline">Online</button>
                    <button class="w-1/2 rounded-e-lg
                     @if($view == 'online') bg-white hover:bg-[#FCFDAF]
                     @else bg-[#DBA159] 
                     @endif text-black py-2 "
                        wire:click="toggleOffline">Offline</button>
                </div>

                <div class="w-4/5 mb-3">
                    <input type="text" wire:model.live="search" placeholder="Search users..."
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="w-4/5 max-h-[50vh] overflow-y-auto scrollBarThin">
                    <table class="w-full table-auto">
                        <tbody>
                            @if($view == 'online')
                                @foreach($online as $user)
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 px-4">{{ $user->name . ' ' . $user->surname }}</td>
                                        <td class="align-middle py-2 px-4">
                                            <div class="w-8 h-8 p-1 flex items-center justify-center leading-none">
                                                <button  @if($user->id == Auth::id())
        disabled
    @else
        wire:click="goToMail({{ $user->id }})"
    @endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                    class="
                                                    @if($user->id == Auth::user()->id) cursor-not-allowed @else cursor-pointer @endif
                                                    w-5 h-5 text-blue-400 overflow-visible" viewBox="0 0 448 512"
                                                    fill="currentColor">
                                                    <path
                                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                                </svg>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($offline as $user)
                                                                       <tr class="border-b border-gray-200">
                                        <td class="py-2 px-4">{{ $user->name . ' ' . $user->surname }}</td>
                                        <td class="align-middle py-2 px-4">
                                            <div class="w-8 h-8 p-1 flex items-center justify-center leading-none">
                                                <button  @if($user->id == Auth::id())
        disabled
    @else
         wire:click="goToMail({{ $user->id }})"
    @endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                    class="
                                                    @if($user->id == Auth::user()->id) cursor-not-allowed @else cursor-pointer @endif
                                                    w-5 h-5 text-blue-400 overflow-visible" viewBox="0 0 448 512"
                                                    fill="currentColor">
                                                    <path
                                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                                </svg>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</div>