<div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
    <div class="w-full flex flex-row border overflow-hidden bg-white rounded-lg border-black">
        @if ($successSend)
            <div x-data x-init="
                                    toastr.success('Message sent successfully');
                                    setTimeout(() => $wire.set('successSend', false), 5000);
                                "></div>
        @endif
        @if ($sendError)
            <div x-data x-init="
                                    toastr.warning('Please fill all fields');
                                    setTimeout(() => $wire.set('successSend', false), 5000);
                                "></div>
        @endif
        <div class="w-1/6 flex flex-col min-h-[70vh]  border-e border-e-black">
           
                <span class=" text-center py-2 border-b border-black font-bold">Inbox</span>
                <div class="overflow-y-scroll h-full scrollBarThin">
                    @if(sizeof($mails) > 0)
            @foreach ($mails as $mail)

<div
    class="p-4 border-y border-y-gray cursor-pointer hover:bg-[#FCFDAF]
    @if ($currentMail && $currentMail->id == $mail->id) bg-[#f7f7ba] border-y border-y-black @endif"
    @if ($mail->is_read == 0 && (!isset($currentMail) || $currentMail->id != $mail->id))
        style="font-weight: bold;"
    @endif
    wire:click="openMail({{ $mail->id }})"
>
    <p>
        @php
            $fromUser = \App\Models\User::find($mail->from_user_id);
            $fromUser = $fromUser ? $fromUser->name . ' ' . $fromUser->surname : 'Unknown';
        @endphp
        {{ $fromUser }}
    </p>
    <p>{{ $mail->subject }}</p>
</div>

            @endforeach
                    @else
                        <div class="p-4 text-center">
                            No messages
                        </div>
                    @endif
</div>

        </div>
        <div class="w-5/6 flex flex-grow min-h-[70vh] ">
            <div class="flex flex-col w-full h-full ">
                <div class="flex flex-row w-full  border-b border-b-black ">
                    <!-- Create Button -->
                    <button wire:click="newMessage"
                        class="hover:bg-blue-400 text-black  px-4 py-2  hover:bg-blue-600 transition duration-200 flex-shrink-0">
                        Create
                    </button>

                    <button wire:click="respond" @if (!$currentMail) disabled @endif class="px-4 py-2 flex-shrink-0
        border-s border-s-black border-t-0 border-e-0 border-b-0
        hover:bg-red-400 hover:bg-red-600 transition duration-200
        text-black
        @if (!$currentMail)
            bg-gray-300 text-gray-500 cursor-not-allowed hover:bg-gray-300 hover:bg-gray-300
        @endif
    ">
                        Reply
                    </button>
@if(!$confirmdelete)
<button
    wire:click="deleteMail" @if (!$currentMail) disabled @endif
    class="
            @if (!$currentMail)
            bg-gray-300 text-gray-500 cursor-not-allowed hover:bg-gray-300 hover:bg-gray-300
        @endif
    hover:bg-red-400 text-black border-s border-s-black border-t-0 border-e border-e-black border-b-0 px-4 py-2 hover:bg-red-600 transition duration-200 flex-shrink-0">
    Delete
</button>
@else
<button
    wire:click="deleteMailConfirm" @if (!$currentMail) disabled @endif
    class="
            @if (!$currentMail)
            bg-gray-300 text-gray-500 cursor-not-allowed hover:bg-gray-300 hover:bg-gray-300
        @endif
    hover:bg-red-400 text-black border-s border-s-black border-t-0 border-e border-e-black border-b-0 px-4 py-2 hover:bg-red-600 transition duration-200 flex-shrink-0">
    Confirm
</button>
@endif
                    <button wire:click="send"
                        class="ml-auto border-s border-s-black border-e-0 border-t-0 border-b-0 hover:bg-green-400 text-black px-4 py-2 hover:bg-green-600 transition duration-200 flex-shrink-0">
                        Send
                    </button>
                </div>

                <form class="flex-grow flex flex-col h-full" action="">
                    @if ($currentMail)

                        <div class="relative w-full ">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 text-gray-600 pointer-events-none">
                                From:
                            </div>
                            <p type="text" name="to" id="to"
                                class="w-full ps-[56px] border-none  bg-white text-black dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                                {{$fromUserName}}
                            </p>
                        </div>

                        <div class="relative w-full">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 text-gray-600 pointer-events-none">
                                Subject:
                            </div>
                            <p type="text" name="to" id="to"
                                class="w-full ps-[76px] border-t border-t-black border-s-0 border-b border-b-black border-e-0  bg-white text-black dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-1 focus:ring-blue-500">
                                {{ $currentMail->subject }}
                            </p>
                        </div>

                        <div class="relative w-full">
                            <p type="text" name="to" id="to"
                                class="w-full flex-grow border-t-0  border-r-0 border-b-0 border-s-0 resize-none bg-white p-2">
                                <span class="text-black">{{ $currentMail->body }}
                            </p>
                        </div>
                    @else
                        <div class="relative w-full">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 text-gray-600 pointer-events-none">
                                To:
                            </div>
<div class="w-full ps-10 relative" x-data="{ open: false }">
    <!-- Dropdown Toggle Button -->
    <button 
        @click="open = !open" 
        type="button"
        class="text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ $recipient ? json_decode($recipient)->name . ' ' . json_decode($recipient)->surname : 'Select' }}
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown Search -->
    <div 
        x-show="open"
        @click.outside="open = false"
        x-transition
        id="dropdownSearch"
        wire:ignore.self
        class="absolute z-10 bg-white rounded-lg shadow-sm w-60 dark:bg-gray-700 mt-2"
    >
        <div class="p-3">
            <label for="input-group-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="input-group-search" 
                    wire:model.live="search" 
                    @input="open = true"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search user">
            </div>
        </div>

        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton">
            @foreach ($allUsers as $user)
                <li>
                    <div class="flex items-center ps-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                        <label 
                            wire:click="changeRecipient({{ $user->id }})" 
                            @click="open = false"
                            class="w-full cursor-pointer py-2 ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">
                            {{ $user->name . ' ' . $user->surname }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>





                        </div>

                        <div class="relative w-full">
                            <div
                                class="absolute inset-y-0 start-0 text-gray-600 flex items-center ps-3.5 pointer-events-none">
                                Subject:
                            </div>
                            <input type="text" name="subject" id="subject" wire:model="subject"
                                class="w-full ps-[76px] border-t border-t-black border-s-0 border-b-0 border-e-0 bg-white text-black dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-1 focus:ring-blue-500"
                                value="{{ $subject ?? '' }}">
                        </div>
                        <div class="flex-grow flex flex-col">
                            <textarea placeholder="Write your message here" name="content" wire:model="content"
                                class="w-full flex-grow border-t border-t-black border-r-0 border-b-0 border-s-0 resize-none bg-white p-2"></textarea>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <script>
            document.querySelectorAll('input[name="user_select"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    // Hide the dropdown by adding the 'hidden' class
                    const dropdown = document.getElementById('dropdownSearch');
                    dropdown.classList.add('hidden');

                    // Optionally update the button text to the selected user's name
                    const button = document.getElementById('dropdownSearchButton');
                    const selectedLabel = document.querySelector(`label[for="${radio.id}"]`);
                    if (selectedLabel) {
                        button.innerHTML = selectedLabel.textContent + ` <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>`;
                    }
                });
            });
        </script>

    </div>