<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام سحاب | Sahab System</title>

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

<body class="antialiased bg-white text-black font-sans selection:bg-black selection:text-white">

    <div class="relative min-h-screen flex flex-col bg-grid-pattern">

        <nav class="w-full py-6 px-6 sm:px-12 flex justify-between items-center bg-white/90 backdrop-blur-md fixed top-0 z-50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-black rounded flex items-center justify-center text-white font-bold text-lg">S</div>
                <span class="font-black text-xl tracking-tighter uppercase">Sahab.</span>
            </div>
        </nav>

        <main class="flex-grow flex flex-col justify-center items-center text-center px-4 pt-24 pb-12">

            <div class="max-w-4xl mx-auto space-y-8">

                <h1 class="text-6xl sm:text-8xl font-black tracking-tighter text-black leading-[1.1]">
                    نظام سحاب<br>
                    <span class="text-4xl sm:text-6xl text-gray-500 mt-2 block">(Sahab System)</span>
                </h1>

                <p class="text-lg sm:text-2xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-bold">
                    وحدة إدارة الطلبات والاعتمادات للأقسام الداخلية.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="group relative inline-flex items-center justify-center px-10 py-4 text-base font-bold text-white transition-all duration-200 bg-black border-2 border-black hover:bg-white hover:text-black focus:outline-none w-full sm:w-auto">
                        الذهاب للوحة التحكم
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="group relative inline-flex items-center justify-center px-10 py-4 text-base font-bold text-white transition-all duration-200 bg-black border-2 border-black hover:bg-white hover:text-black focus:outline-none w-full sm:w-auto">
                        تسجيل الدخول (Login)
                    </a>
                    @endauth
                    @endif
                </div>
            </div>

        </main>



    </div>
</body>

</html>