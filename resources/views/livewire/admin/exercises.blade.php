<div class="h-screen w-full p-6  overflow-y-auto scrollBarThin">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @for ($i = 1; $i < 5; $i++)
            <div class="border h-[18rem] border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white">
                <h5 class="text-xl font-medium tracking-tight ps-4 pt-2 text-gray-900 dark:text-white">
                    Part {{ $i }}
                </h5>

                <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                    <input type="text" wire:model.live="search{{ $i }}"
                        class="flex-grow rounded-md text-sm border border-gray-300 p-2 mr-4" placeholder="Search" />
                    <a href="{{ route('admin.exercises.create', ['part' => $i]) }}">
                        <button type="button" wire:click="toggleCards"
                            class="h-auto flex items-center bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded-md transition">
                            Add New Exercise
                        </button>
                    </a>
                </div>

                <div class="max-h-48 w-full overflow-y-auto scrollBarThin">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 sticky top-0 border-b border-gray-300 dark:border-gray-600">
                            <tr>
                                <th class="px-4 text-center py-2">Title</th>
                                <th class="px-4 w-2/6 text-center py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (${'part' . $i} as $exercise)
                                <tr
                                    class="bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 text-black">{{ $exercise->title }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex w-full gap-2">
                                            <a href="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}"
                                                class="flex-1">
                                                <button
                                                    class="w-full px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">
                                                    Edit
                                                </button>
                                            </a>
                                            <div class="flex-1">
                                                <button
                                                    class="w-full px-4 py-1 bg-gray-300 border border-gray-400 rounded hover:bg-red-400 text-black transition-colors">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endfor

    </div>
