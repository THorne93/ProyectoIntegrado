<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="border border-black rounded-lg shadow-sm overflow-hidden bg-white p-4">
            <form action="{{ route('admin.exercises.create', ['part' => 4]) }}" method="POST" class="max-w mx-auto"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div>
                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title" required
                            class="bg-white  border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('title') }}" @error('title') <h5 style="color:red">{{ $message }}</h5>
                            @enderror
                    </div>
                    <div class="mx-2">
                        <p class="text-gray-600 mt-2 py-2" p>For multiple possible words use a "/" to separate them, eg.
                            big/large/huge. Hints should be in uppercase eg. BIG. For multiple possible answers use the
                            + button to add them, - to remove.</p>
                        @for ($index = 0; $index < 6; $index++)
                            <div class="py-4">
                                <div class="my-1">
                                    <span class="text-lg font-semibold w-4 mr-2">{{ $index + 1 }}</span>
                                    <input type="text" required name="answers[{{ $index }}][prompt]"
                                        class="min-w-2/5 border border-black auto-resize-input  rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.prompt') }}">
                                </div>

                                <div class="my-1">
                                    <input type="text" required name="answers[{{ $index }}][hint]"
                                        class="min-w-1/6 border border-black auto-resize-input rounded px-2 py-1 ms-5 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.hint') }}">
                                </div>
                                <div class="flex items-start space-x-2 mb-1 a1-a2-group">
                                    <input type="text" required name="answers[{{ $index }}][before]"
                                        class="before-input min-w-1/6 auto-resize-input border rounded border-black px-2 ms-5 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.before') }}">
                                    <div class="a1-a2-wrapper space-y-1">
                                        <div class="a1-a2-pair w-full">
                                            <span class="text-s text-gray-600">a1</span>
                                            <input type="text" required name="answers[{{ $index }}][option][0][a1]"
                                                class=" border min-w-1/6 auto-resize-input border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                                value="{{ old('answers.' . $index . '.option.0.a1') }}">

                                            <span class="text-s text-gray-600">a2</span>
                                            <input type="text" required name="answers[{{ $index }}][option][0][a2]"
                                                class=" border min-w-1/6 auto-resize-input border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                                value="{{ old('answers.' . $index . '.option.0.a2') }}">
                                            <button type="button"
                                                class="text-black hover:bg-green-400 h-8 w-8 hover:border hover:border-black rounded-full add-a1-a2"
                                                data-index="{{ $index }}">+</button>
                                        </div>
                                    </div>

                                    <input type="text" required name="answers[{{ $index }}][after]"
                                        class="after-input min-w-1/6 auto-resize-input border rounded border-black px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.after') }}">
                                </div>
                            </div>
                        @endfor

                    </div>
                    <div class="flex justify-center w-full mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-white border border-black rounded hover:bg-green-400 text-black transition-colors">Submit</button>
                    </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function addResizeListener(input) {
                const resize = () => {
                    input.style.width = 'auto' 
                    input.style.width = input.scrollWidth + 'px' 
                } 
                input.addEventListener('input', resize) 
                resize() 
            }
            document.querySelectorAll('.auto-resize-input').forEach(addResizeListener) 
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-a1-a2')) {
                    const pair = e.target.closest('.a1-a2-pair') 
                    if (pair) {
                        pair.remove() 
                    }
                }
            }) 
            document.querySelectorAll('.add-a1-a2').forEach(button => {
                button.addEventListener('click', function () {
                    const group = this.closest('.a1-a2-group') 
                    if (!group) return 
                    const index = this.dataset.index 
                    const wrapper = group.querySelector('.a1-a2-wrapper') 
                    if (!wrapper) return 
                    const existingPairs = wrapper.querySelectorAll('.a1-a2-pair').length 
                    const newIndex = existingPairs 
                    const newRow = document.createElement('div') 
                    newRow.className = 'a1-a2-pair w-full' 
                    newRow.innerHTML = `
                    <span class="text-s text-gray-600 align-top">a1</span>
                    <input type="text" required name="answers[${index}][option][${newIndex}][a1]"
                        class="w-12 auto-resize-input border border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white">

                    <span class="text-s text-gray-600 align-top">a2</span>
                    <input type="text" required name="answers[${index}][option][${newIndex}][a2]"
                        class="w-12 auto-resize-input border border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white">

                    <button type="button" class="text-black hover:bg-red-400 h-8 w-8 hover:border hover:border-black rounded-full remove-a1-a2">−</button>
                ` 
                    wrapper.appendChild(newRow) 
                    newRow.querySelectorAll('.auto-resize-input').forEach(addResizeListener) 
                    newRow.querySelector('.remove-a1-a2').addEventListener('click', () => newRow.remove()) 
                }) 
            }) 
        }) 
    </script>


</x-app-layout>