<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="border border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white p-4">
            <form action="{{ route('admin.exercises.create', ['part' => 1]) }}" method="POST" class="max-w mx-auto"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div>
                    <div class="mb-5">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('title') }}">
                        @error('title')
                            <h5 style="color:red">{{ $message }}</h5>
                        @enderror
                    </div>

                    <label for="image_input" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                        Image to Extract Text</label>
                    <div class="mb-5 flex flex-col md:flex-row w-full gap-4">
                        <input type="file" name="image_input" id="image_input"
                            class="block w-full md:w-2/3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <button type="button" id="extractTextBtn"
                            class="w-full md:w-1/3 bg-gray-100 border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700">
                            Extract Text from Image
                        </button>
                    </div>

                    <div class="mb-5">
                        <input type="hidden" name="content" id="hidden_content" value="{{ old('content') }}">
                        <div id="content">{!! old('content') !!}</div>
                        @error('content')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Placeholder: Assume 1 default question with 4 choices --}}
                @for ($i = 0; $i < 9; $i++)
                    <div class="flex items-center mb-4 w-full">
                        <span class="text-lg font-semibold mr-2">{{ $i }}</span>
                        <ul
                            class="flex flex-row justify-between gap-4 mx-2 w-full text-sm font-medium text-gray-900 bg-white rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @for ($j = 0; $j < 4; $j++)
                                <li class="flex flex-1 items-center gap-2">
                                    <input type="radio" id="question-{{ $i }}-option-{{ $j }}"
                                        name="question[{{ $i }}][choice]" value="{{ $j }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        @if (old("question.$i.choice") == $j) checked @endif>
                                    <input type="text" required
                                        name="question[{{ $i }}][choices][{{ $j }}]"
                                        class="w-full border rounded px-2 py-1 bg-white text-black dark:bg-gray-800 dark:text-white"
                                        value="{{ old('question.' . $i . '.choices.' . $j) }}">
                                </li>
                            @endfor
                        </ul>
                    </div>
                @endfor

                <div class="flex justify-center w-full mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-300 border border-gray-400 rounded hover:bg-green-400 text-black transition-colors">Submit</button>
                </div>
            </form>

        </div>
        @push('scripts')
            <script>
                let quill; // declare globally so both scripts can access

                function loadScript(url, callback) {
                    const script = document.createElement('script');
                    script.src = url;
                    script.onload = callback;
                    document.head.appendChild(script);
                }

                loadScript('https://cdn.quilljs.com/1.3.6/quill.min.js', function() {
                    loadScript('https://cdn.jsdelivr.net/npm/quill-image-uploader@1.3.0/dist/quill.imageUploader.min.js',
                        function() {
                            Quill.register("modules/imageUploader", window.ImageUploader);

                            quill = new Quill("#content", {
                                theme: "snow",
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline', 'strike'],
                                        ['blockquote'],
                                        [{
                                            'list': 'ordered'
                                        }, {
                                            'list': 'bullet'
                                        }],
                                        [{
                                            'size': ['small', false, 'large', 'huge']
                                        }],
                                    ],
                                }
                            });

                            quill.on('text-change', function() {
                                document.getElementById("hidden_content").value = quill.root.innerHTML;
                            });
                        });
                });

                document.getElementById('extractTextBtn').addEventListener('click', function() {
                    const fileInput = document.getElementById('image_input');
                    if (fileInput.files.length === 0) {
                        alert('Please select an image file first.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('image', fileInput.files[0]);

                    fetch('/extract-text', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (quill) {
                                quill.insertText(quill.getSelection(true).index, data.text);
                            } else {
                                alert('Quill editor not loaded.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Text extraction failed.');
                        });
                });
            </script>
        @endpush
    </div>


</x-app-layout>
