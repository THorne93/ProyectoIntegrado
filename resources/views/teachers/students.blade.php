<x-app-layout>
    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-12">

            @foreach ($students as $student)
                <a href=""
                    class="p-6 col col-4 min-w-full min-h-36 bg-white border border-gray-400 rounded-lg shadow-sm hover:bg-gray-100 
               dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700  ">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                        </svg>
                    </div>
                    <div class="flex gap-8 items-center">
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
                                class="text-base lg:text-xl  tracking-tight truncate text-gray-900 dark:text-white">
                                {{ $student->name . ' ' . $student->surname }}
                            </h5>
                            <h5 class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                                Last active: {{ \Carbon\Carbon::parse($student->date)->diffForHumans() }}
                            </h5>
                            <h5 title="{{ $student->email }}"
                                class="text-base lg:text-xl tracking-tight truncate text-gray-900 dark:text-white">
                                {{ $student->email }}
                            </h5>
                        </div>
                    </div>


                </a>
            @endforeach

        </div>
    </div>
</x-app-layout>
