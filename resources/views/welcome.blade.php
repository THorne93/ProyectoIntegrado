<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
        <div class="flex flex-row  w-4/5 max-w-7xl m-4 gap-12 items-center justify-center">

            <!-- Left Panel -->
            <div class="flex w-full bg-gray-100 border border-gray-400 rounded overflow-hidden">

                <!-- Column 1: Image -->
                <div class="w-4/6 p-2 h-full">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden justify-center items-center rounded-lg md:h-96">
                            @for ($index = 1; $index < 8; $index++)
                                <div class="hidden my-auto duration-700 ease-in-out" data-carousel-item>
                                    <img src="/storage/img/{{$index}}.jpg" class="h-full w-full object-contain object-center" alt="...">
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>

                <!-- Column 2: Text -->
                <div class="w-2/6 bg-gray-100 flex flex-col items-center justify-center p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        Results. Fast.
                    </h2>

                    <ul class="text-gray-600 ms-3 ps-3 text-sm space-y-2">
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