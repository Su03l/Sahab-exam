<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-black leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-black p-12 text-center shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

                <h3 class="font-black text-3xl mb-10">مرحباً بك، {{ Auth::user()->name }}</h3>

                <a href="{{ route('requests.index') }}" class="inline-block bg-black text-white font-bold text-xl px-12 py-5 border-2 border-black hover:bg-white hover:text-black transition-colors">
                    الانتقال إلى نظام الطلبات
                </a>

            </div>
        </div>
    </div>
</x-app-layout>