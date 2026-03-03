<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sahab') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-grid-pattern {
            background-image: radial-gradient(#d1d5db 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-black selection:bg-black selection:text-white">
    <div class="min-h-screen flex flex-col justify-center items-center bg-grid-pattern py-12 px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <a href="/" class="flex flex-col items-center gap-2">
                <div class="w-12 h-12 bg-black rounded flex items-center justify-center text-white font-bold text-2xl">S</div>
                <span class="font-black text-2xl tracking-tighter uppercase">Sahab.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-white border-2 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            {{ $slot }}
        </div>

    </div>
</body>

</html>