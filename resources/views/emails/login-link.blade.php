<?php
$logopath = public_path('storage/img/logo.png');
$logo = file_exists($logopath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logopath)) : null;
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/04e8bd4d22.js" crossorigin="anonymous"></script>
    <title>Login Instructions</title>
</head>

<body style="background-color: #f9fafb; margin: 0; padding: 0; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; padding: 24px;">

        <div
            style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 32px; text-align: left;">


            @if ($logo)
                <div style="text-align: center;">
                    <div style="margin-bottom: 24px;"></div>
                    <img src="{{ $logo }}" alt="Logo" style="width: 150px;">
                </div>
            @endif
            <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 16px;">
                Welcome to B2Go, {{ $user->name }}! 👋
            </h2>

            <p style="font-size: 16px; color: #4b5563; margin-bottom: 24px;">
                @if($school)
                    You have been successfully added to your class at {{ is_string($school) ? $school : $school->name }}. Click below to access your account:
                @else
                    You have been successfully added the platform. Click below to access your account:
                @endif
            </p>

            <p style="font-size: 16px; color: #4b5563; margin-bottom: 24px;">
                Your password is 1234. Please change it after your first login.
            </p>
            <div style="margin-bottom: 32px; text-align: center;">
                <a href="{{ $loginUrl }}"
                    style="display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 12px 32px; border-radius: 8px; font-weight: 500; font-size: 16px;">
                    Get Started →
                </a>
            </div>

            <div style="font-size: 12px; color: #6b7280; text-align: center;">
                <p>© {{ now()->year }} B2Go. All rights reserved.</p>
                <p style="margin-top: 8px;">123 Business Street, Suite 456</p>
            </div>
        </div>
    </div>
    </div>
</body>


</html>