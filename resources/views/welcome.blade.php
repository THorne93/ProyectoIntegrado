<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>B2 Lab</title>
    <meta name="description" content="B2 Lab - Cambridge B2 exam preparation">
    <meta name="keywords" content="B2 Lab, Cambridge B2, exam preparation, English language, practice tests">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="/public/favicon.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/public/favicon.png" sizes="32x32">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans appbg min-h-screen flex flex-col justify-between">
    <livewire:layout.navigation />
    <!-- Main Content Area -->
    <div class="flex-grow flex items-center justify-center">
        <div class="flex flex-row  w-4/5 max-w-7xl   items-center justify-center">

            <!-- Left Panel -->
            <div class="flex w-full  rounded overflow-hidden">

                <!-- Column 1: Image -->
                <div class="w-4/6  m-4 h-full">
                    <img src="/storage/img/welcome.png" class="rounded-lg" alt="">
                </div>

                <!-- Column 2: Text -->
                <div
                    class="w-2/6 m-4 border border-black rounded-lg bg-white flex flex-col items-center justify-center p-6">
                    <img src="/storage/img/logo.png" class="w-auto h-16 mx-auto" alt="Logo">

                    <h2 class="text-3xl font-semibold text-black ">
                        Results. Fast.
                    </h2>
                    <p class="mb-6">Cambridge B2 exam preparation</p>
                    <ul class="text-gray-600 ms-3 text-sm space-y-2">
                        <li><span class="text-green-500 font-extrabold">✓</span> Multiple exam exercises</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Proven results</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Instant feedback</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Real exam simulations</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Performance analytics</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Track your progress</li>
                        <li><span class="text-green-500 font-extrabold">✓</span> Practice anytime, anywhere</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="py-6 text-center text-sm text-black dark:text-white/70">
        B2 Exam Lab &copy; {{ date('Y') }}. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>
