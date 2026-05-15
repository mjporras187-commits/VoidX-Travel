<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'VOIDX') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { background-color: #080808 !important; color: white !important; }
            .bg-white { background-color: #0d0d0d !important; }
            .text-gray-800 { color: #d4af37 !important; }
            .bg-gray-100 { background-color: #080808 !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#080808] text-white">
        <div class="min-h-screen bg-[#080808]">
            @include('layouts.navigation')

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>