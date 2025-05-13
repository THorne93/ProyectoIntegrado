<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="p-4">
            @if (Auth::user()->role === 'Admin')
                @livewire('dashboard-admin')
            @elseif(Auth::user()->role === 'Teacher')
                @livewire('dashboard-teacher')
                <div class="grid grid-cols-2 gap-x-8 gap-y-12 justify-items-center items-center">
                </div>
            @else
                <div class="grid grid-cols-2 gap-x-8 gap-y-12 justify-items-center items-center ">

                    <div
                        class="place-self-center flex flex-col items-center max-w-sm p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-one-stats')

                        <button type="button"
                            class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Practise now!
                        </button>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center max-w-sm p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-two-stats')

                        <button type="button"
                            class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Practise now!
                        </button>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center max-w-sm p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-three-stats')

                        <button type="button"
                            class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Practise now!
                        </button>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center max-w-sm p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-four-stats')

                        <button type="button"
                            class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Practise now!
                        </button>
                    </div>




                </div>
            @endif


        </div>





    </div>
</x-app-layout>
