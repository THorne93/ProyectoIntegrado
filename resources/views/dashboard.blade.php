<x-app-layout>
    <div class=" h-screen w-full px-6 pb-12 overflow-y-scroll scrollBarThin">
        <div class="p-4">
            @if (Auth::user()->role === 'Admin')
                @livewire('dashboard-admin')
            @else
                <h3 class="text-center font-extrabold underline pb-2">Your most recent stats</h3>

                <div class="w-4/5 mx-auto grid grid-cols-2 gap-4 justify-items-center items-center ">
                    <div
                        class="place-self-center flex flex-col items-center  h-72 w-full p-6  bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-one-stats')
                        <a href="{{ route('exercises.part', ['part' => 1]) }}">
                            <button type="button"
                                class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Practise now!
                            </button>
                        </a>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center w-full  h-72 p-6  bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-two-stats')
                        <a href="{{ route('exercises.part', ['part' => 2]) }}">
                            <button type="button"
                                class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Practise now!
                            </button>
                        </a>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center w-full  h-72 p-6  bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-three-stats')
                        <a href="{{ route('exercises.part', ['part' => 3]) }}">
                            <button type="button"
                                class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Practise now!
                            </button>
                        </a>
                    </div>
                    <div
                        class="place-self-center flex flex-col items-center w-full  h-72 p-6  bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        @livewire('dashboard-part-four-stats')
                        <a href="{{ route('exercises.part', ['part' => 4]) }}">
                            <button type="button"
                                class="text-gray-900 bg-gray-100 border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Practise now!
                            </button>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>