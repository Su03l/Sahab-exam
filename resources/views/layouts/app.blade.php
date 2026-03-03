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
</head>

<body class="font-sans antialiased bg-white text-black selection:bg-black selection:text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="w-full py-4 px-6 sm:px-12 flex justify-between items-center border-b-2 border-black bg-white sticky top-0 z-50">
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-black rounded flex items-center justify-center text-white font-bold text-lg">S</div>
                    <span class="font-black text-xl tracking-tighter uppercase">Sahab.</span>
                </a>

                <div class="hidden sm:flex items-center gap-6 ml-10">
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold border-b-2 {{ request()->routeIs('dashboard') ? 'border-black' : 'border-transparent hover:border-black' }} transition-all pb-1">لوحة التحكم</a>
                    <a href="{{ route('requests.index') }}" class="text-sm font-bold border-b-2 {{ request()->routeIs('requests.*') ? 'border-black' : 'border-transparent hover:border-black' }} transition-all pb-1">الطلبات</a>
                </div>
            </div>

            <div class="flex items-center gap-6" x-data="{ open: false, logoutModalOpen: false }">

                <div class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm font-bold border-2 border-transparent hover:border-black p-1.5 transition-all">
                        <div class="flex flex-col text-right">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500">{{ Auth::user()->role === \App\Enums\UserRole::MANAGER ? 'مدير النظام' : 'موظف' }}</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 mt-2 w-48 bg-white border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-50 text-right"
                        style="display: none;">

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm font-bold hover:bg-black hover:text-white transition-colors border-b-2 border-black">
                            الملف الشخصي
                        </a>

                        <button @click="logoutModalOpen = true; open = false" class="w-full text-right px-4 py-3 text-sm font-bold text-red-600 hover:bg-black hover:text-white transition-colors">
                            تسجيل الخروج
                        </button>
                    </div>
                </div>

                <!-- Custom Logout Modal -->
                <div x-show="logoutModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
                    <button @click="logoutModalOpen = false" class="absolute inset-0 w-full h-full cursor-default"></button>

                    <div class="relative bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] w-full max-w-sm p-8 text-center"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100">

                        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-red-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-black mb-2">تأكيد تسجيل الخروج</h3>
                        <p class="text-gray-600 text-sm font-medium mb-6">هل أنت متأكد أنك تريد تسجيل الخروج من نظام سحاب؟</p>

                        <div class="flex gap-4">
                            <button @click="logoutModalOpen = false" class="flex-1 px-4 py-2 border-2 border-black font-bold text-sm hover:bg-gray-100 transition-colors">
                                إلغاء
                            </button>
                            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 border-2 border-red-600 text-white font-bold text-sm hover:bg-white hover:text-red-600 transition-colors">
                                    تأكيد
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>



    </div>
</body>

</html>