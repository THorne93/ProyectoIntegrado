<x-app-layout>
    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="border border-black rounded-lg shadow-sm overflow-hidden bg-white p-4">
            <form action="{{ route('admin.exercises.edit', ['part' => $exercise->part, 'id' => $exercise->id]) }}"
                method="POST" class="max-w mx-auto" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div>
                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title" required
                            class="bg-white  border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('title', $exercise->title) }}">

                        @error('title') <h5 style="color:red">{{ $message }}</h5>
                        @enderror
                    </div>
                    <div class="mx-2">
                        <div class="text-gray-600 mt-2 py-2">
                            <p>For multiple possible words use a "/" to separate them, eg.
                                big/large/huge. Hints should be in uppercase eg. BIG.</p>
                            <p> For multiple possible answers use the
                                +
                                button to add them, - to remove.</p>
                        </div>
                        @foreach ($questions as $index => $question)
                            <div class=" py-4">
                                <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $question->id }}">
                                <div class="my-1">
                                    <span class="text-lg font-semibold w-4 mr-2">{{ $index + 1 }}</span>
                                    <input type="text" required name="answers[{{ $index }}][prompt]"
                                        class="min-w-2/5 auto-resize-input border border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.prompt', $question->prompt) }}">
                                </div>
                                <div class="my-1">
                                    <input type="text" required name="answers[{{ $index }}][hint]"
                                        class="min-w-1/6 border border-black auto-resize-input  rounded px-2 py-1 ms-5 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.hint', $question->answers[0]->hint) }}">
                                </div>
                                @php
                                    $answerParts = collect(json_decode($question->answers[0]->value))->map(function ($item) {
                                        [$a1, $a2] = explode('|', $item);
                                        return ['a1' => $a1, 'a2' => $a2];
                                    })->toArray();
                                @endphp
                                <div class="flex items-start space-x-2 mb-1">
                                    <input type="text" required name="answers[{{ $index }}][before]"
                                        class="before-input min-w-1/6 border border-black auto-resize-input rounded px-2 py-1 ms-5 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.before', $question->before_prompt) }}">
                                    <div class="a1-a2-wrapper min-w-2/6 space-y-1">
                                        @foreach ($answerParts as $index2 => $answer)
                                            <div class="a1-a2-pair w-full">
                                                <span class="text-s text-gray-600">a1</span>
                                                <input type="text" required
                                                    name="answers[{{ $index }}][option][{{$index2}}][a1]"
                                                    class=" border min-w-1/6 auto-resize-input border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                                    value="{{ old('answers.' . $index . '.option.' . $index2 . '.a1', $answer['a1']) }}">

                                                <span class="text-s text-gray-600">a2</span>
                                                <input type="text" required
                                                    name="answers[{{ $index }}][option][{{$index2}}][a2]"
                                                    class=" border min-w-1/6 auto-resize-input border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                                    value="{{ old('answers.' . $index . '.option.' . $index2 . '.a2', $answer['a2']) }}">

                                                @if ($index2 !== 0)
                                                    <button type="button"
                                                        class="text-black hover:bg-red-400 h-8 w-8 hover:border hover:border-black rounded-full remove-a1-a2">−</button>
                                                @else
                                                    <button type="button"
                                                        class="text-black hover:bg-green-400 h-8 w-8 hover:border hover:border-black rounded-full add-a1-a2"
                                                        data-index="{{ $index }}">+</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="text" required name="answers[{{ $index }}][after]"
                                        class="after-input min-w-1/6 border auto-resize-input border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('answers.' . $index . '.after', $question->after_prompt) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                    const answerDiv = this.closest('.flex.items-start')
                    if (!answerDiv) return
                    const index = this.dataset.index
                    const wrapper = answerDiv.querySelector('.a1-a2-wrapper')
                    if (!wrapper) return
                    const existingPairs = wrapper.querySelectorAll('.a1-a2-pair').length
                    const newIndex = existingPairs
                    const newRow = document.createElement('div')
                    newRow.className = 'a1-a2-pair w-full'
                    newRow.innerHTML = `
                    <span class="text-s text-gray-600 align-top">a1</span>
                    <input type="text" required name="answers[${index}][option][${newIndex}][a1]"
                        class="min-w-1/6 auto-resize-input border border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white">

                    <span class="text-s text-gray-600 align-top">a2</span>
                    <input type="text" required name="answers[${index}][option][${newIndex}][a2]"
                        class="min-w-1/6 auto-resize-input border border-black rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white">

                    <button type="button" class="text-black hover:bg-red-400 h-8 w-8 hover:border hover:border-black rounded-full remove-a1-a2">−</button>
                `
                    wrapper.appendChild(newRow)
                    newRow.querySelectorAll('.auto-resize-input').forEach(addResizeListener)
                    newRow.querySelector('.remove-a1-a2').addEventListener('click', function () {
                        newRow.remove()
                    })
                })
            })
        }) 
    </script>


</x-app-layout>