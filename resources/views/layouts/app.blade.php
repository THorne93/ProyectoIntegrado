<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.3.0/dist/quill.imageUploader.min.css">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.3.0/dist/quill.imageUploader.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <script src="https://kit.fontawesome.com/04e8bd4d22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased appbg overflow-hidden">

    <div class="min-h-screen flex md:flex-row flex-row">
        <livewire:layout.sidenav />

        <main class="flex w-full flex-col">
            <livewire:layout.navigation />
            {{ $slot }}
        </main>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('logo-sidebar');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            if (sidebar.classList.contains('hidden')) {
                toggleBtn.textContent = '→';
            } else {
                toggleBtn.textContent = '←';
            }
        });
        document.addEventListener('livewire:load', () => {
            console.log('Livewire has loaded!');
        });
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('msg'))
            toastr.warning("{{ session('msg') }}");
        @endif
    </script>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @stack('scripts')

</body>

</html>
