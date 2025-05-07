<div class="h-screen w-full p-6  overflow-y-auto scrollBarThin">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="border h-[18rem] border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white">
            <h5 class="text-xl font-medium tracking-tight ps-4 pt-2 text-gray-900 dark:text-white">
                Part 1
            </h5>

            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                <input type="text" wire:model.live="search1"
                    class="flex-grow rounded-md text-sm border border-gray-300 p-2 mr-4" placeholder="Search" />
                <a href="{{ route('admin.exercises.create', ['part' => 1]) }}">
                    <button type="button" wire:click="toggleCards"
                        class="h-auto flex items-center bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded-md transition">
                        Add New Exercise
                    </button>
                </a>
            </div>

            <div class="max-h-48 w-full overflow-y-auto scrollBarThin">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-4 text-center py-2">Title</th>
                            <th class="px-4 text-center py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($part1 as $exercise)
                            <tr
                                class="bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-2">{{ $exercise->title }}</td>
                                <td class="px-4 py-2">
                                    <a
                                        href="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}">
                                        <button
                                            class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                                            Edit
                                        </button>
                                    </a>
                                    <button
                                        class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border h-[18rem] border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white">
            <h5 class="text-xl font-medium tracking-tight ps-4 pt-2 text-gray-900 dark:text-white">
                Part 2
            </h5>

            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                <input type="text" wire:model.live="search2"
                    class="flex-grow rounded-md text-sm border border-gray-300 p-2 mr-4" placeholder="Search" />
                <a href="{{ route('admin.exercises.create', ['part' => 2]) }}">
                    <button type="button" wire:click="toggleCards"
                        class="h-auto flex items-center bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded-md transition">
                        Add New Exercise
                    </button>
                </a>
            </div>

            <div class="max-h-48 w-full overflow-y-auto scrollBarThin">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-4 text-center py-2">Title</th>
                            <th class="px-4 text-center py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($part2 as $exercise)
                            <tr
                                class="bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-2">{{ $exercise->title }}</td>
                                <td class="px-4 py-2">
                                    <a
                                        href="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}">
                                        <button
                                            class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                                            Edit
                                        </button>
                                    </a>
                                    <button
                                        class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border h-[18rem] border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white">
            <h5 class="text-xl font-medium tracking-tight ps-4 pt-2 text-gray-900 dark:text-white">
                Part 3
            </h5>

            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                <input type="text" wire:model.live="search3"
                    class="flex-grow rounded-md text-sm border border-gray-300 p-2 mr-4" placeholder="Search" />
                <a href="{{ route('admin.exercises.create', ['part' => 3]) }}">
                    <button type="button" wire:click="toggleCards"
                        class="h-auto flex items-center bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded-md transition">
                        Add New Exercise
                    </button>
                </a>
            </div>

            <div class="max-h-48 w-full overflow-y-auto scrollBarThin">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-4 text-center py-2">Title</th>
                            <th class="px-4 text-center py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($part3 as $exercise)
                            <tr
                                class="bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-2">{{ $exercise->title }}</td>
                                <td class="px-4 py-2">
                                    <a
                                        href="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}">
                                        <button
                                            class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                                            Edit
                                        </button>
                                    </a>
                                    <button
                                        class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border h-[18rem] border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white">
            <h5 class="text-xl font-medium tracking-tight ps-4 pt-2 text-gray-900 dark:text-white">
                Part 4
            </h5>

            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                <input type="text" wire:model.live="search4"
                    class="flex-grow rounded-md text-sm border border-gray-300 p-2 mr-4" placeholder="Search" />
                <a href="{{ route('admin.exercises.create', ['part' => 4]) }}">
                    <button type="button" wire:click="toggleCards"
                        class="h-auto flex items-center bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded-md transition">
                        Add New Exercise
                    </button>
                </a>
            </div>

            <div class="max-h-48 w-full overflow-y-auto scrollBarThin">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-4 text-center py-2">Title</th>
                            <th class="px-4 text-center py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($part4 as $exercise)
                            <tr
                                class="bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-2">{{ $exercise->title }}</td>
                                <td class="px-4 py-2">
                                    <a
                                        href="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}">
                                        <button
                                            class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                                            Edit
                                        </button>
                                    </a>
                                    <button
                                        class="flex-1 px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>