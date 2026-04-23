<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-900 antialiased">
        <div class="theme-shell min-h-screen flex flex-col justify-center items-center px-4 py-10">
            <div>
                <a href="/">
                    <x-application-logo class="h-24 w-auto drop-shadow-[0_20px_30px_rgba(127,29,29,0.22)]" />
                </a>
            </div>

            <div class="glass-panel w-full max-w-md mt-8 overflow-hidden rounded-[2rem] px-6 py-7 sm:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
