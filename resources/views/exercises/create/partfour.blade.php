<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="border border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white p-4">
            <form action="{{ route('admin.exercises.create', ['part' => 4]) }}"
                method="POST" class="max-w mx-auto" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div>
                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title"  required
                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('title') }}" @error('title') <h5 style="color:red">{{ $message }}</h5>
                            @enderror
                    </div>
                    <div class="mx-2">
                        <p class="text-gray-600 mt-2 py-2" p>For multiple possible options use a "/" to separate them,
                            eg.
                            big/large/huge. Hints should be in uppercase eg. BIG.</>
                            @for ($index = 0; $index < 6; $index++)
                                <div class="py-4">
                                    <div class="my-1">
                                        <span class="text-lg font-semibold w-4 mr-2">{{ $index + 1 }}</span>
                                        <input type="text" required name="answers[{{ $index }}][prompt]"
                                            class="min-w-2/5 auto-resize-input border rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.prompt') }}">
                                    </div>

                                    <div class="my-1">
                                        <input type="text" required name="answers[{{ $index }}][hint]"
                                            class="min-w-1/6 border auto-resize-input rounded px-2 py-1 ms-5 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.hint') }}">
                                    </div>

                                    <div>
                                        <input type="text" required name="answers[{{ $index }}][before]"
                                            class="min-w-1/6 auto-resize-input border rounded px-2 py-1 ms-5 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.before') }}">

                                        <span class="text-s text-gray-600 align-top">a1</span>
                                        <input type="text" required name="answers[{{ $index }}][a1]"
                                            class="w-12 auto-resize-input border rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.a1') }}">

                                        <span class="text-s text-gray-600 align-top">a2</span>
                                        <input type="text" required name="answers[{{ $index }}][a2]"
                                            class="w-12 auto-resize-input border rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.a2') }}">

                                        <input type="text" required name="answers[{{ $index }}][after]"
                                            class="min-w-1/6 auto-resize-input border rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                            value="{{ old('answers.' . $index . '.after') }}">
                                    </div>
                                </div>
                            @endfor

                    </div>
                    <div class="flex justify-center w-full mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">Submit</button>
                    </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.auto-resize-input').forEach(input => {
                const resize = () => {
                    input.style.width = 'auto';
                    input.style.width = input.scrollWidth + 'px';
                };

                input.addEventListener('input', resize);
                resize();
            });
        });
    </script>

</x-app-layout>