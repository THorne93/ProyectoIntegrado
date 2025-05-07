<x-app-layout>

    <div class=" h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
        <div class="border border-gray-400 rounded-lg shadow-sm overflow-hidden bg-white p-4">
            <form action="" method="post" class="max-w mx-auto" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-5">
                    <label for="base-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('title', $exercise->title) }}"
                        @error('title')
                        <h5 style="color:red">{{ $message }}</h5>
                    @enderror
                        </div>
                    <div class="mb-5">
                        <label for="image_input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image to Extract
                            Text</label>
                        <input type="file" name="image_input" id="image_input"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    </div>

                    <div class="mb-5">
                        <button type="button" id="extractTextBtn"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700">
                            Extract Text from Image
                        </button>
                    </div>

                    <div class="mb-5">

                        <input type="hidden" name="content" id="hidden_content"
                            value="{{ old('content', $exercise->questions[0]->prompt) }}">
                        <div id="content">{!! old('content', $exercise->questions[0]->prompt) !!}</div>

                        @error('content')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

            </form>
        </div>





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

</x-app-layout>
