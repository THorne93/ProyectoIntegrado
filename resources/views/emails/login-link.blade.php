<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <script src="https://kit.fontawesome.com/04e8bd4d22.js" crossorigin="anonymous"></script>
    <title>Login Instructions</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-md mx-auto p-6">
        <div class="text-center">
            <!-- Logo/Header -->

            <img src="/storage/img/logo.png" alt="Company Logo" class="h-12 mx-auto mb-6">

            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Welcome, {{ $user->name }}! 👋</h2>

                <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg">
                    You have been successfully addded to your class at {{ $school }}. Click below to access your
                    account:
                </p>

                <!-- Login Button -->
                <div class="mb-8">
                    <a href="{{ $loginUrl }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg 
                              transition-all duration-200 transform hover:scale-105">
                        Get Started →
                    </a>
                </div>


                <!-- Footer -->
                <div class="mt-6 text-center text-gray-500 dark:text-gray-400 text-xs">
                    <p>© {{ now()->year }} Your Company Name. All rights reserved.</p>
                    <p class="mt-2">123 Business Street, Suite 456</p>
                </div>
            </div>
        </div>
</body>

</html>