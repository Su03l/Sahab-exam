<x-guest-layout>
    <!-- Session Status -->
    <div class="mb-6">
        <h2 class="text-3xl font-black tracking-tighter mb-2">تسجيل الدخول</h2>
        <p class="text-gray-600 font-medium text-sm">مرحباً بك مجدداً في نظام سحاب.</p>
    </div>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-bold text-sm text-black mb-1">البريد الإلكتروني</label>
            <input id="email" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-bold text-sm text-black mb-1">كلمة المرور</label>
            <input id="password" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="password" name="password" required autocomplete="current-password" />
            @error('password')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="border-2 border-black text-black focus:ring-black rounded-none w-5 h-5 cursor-pointer" name="remember">
                <span class="mr-2 text-sm font-bold text-black cursor-pointer">تذكرني</span>
            </label>

            @if (Route::has('password.request'))
            <a class="text-sm font-bold text-gray-600 hover:text-black hover:underline" href="{{ route('password.request') }}">
                نسيت كلمة المرور؟
            </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-black text-white font-bold text-base px-8 py-3 hover:bg-white hover:text-black border-2 border-black transition-all">
                تسجيل الدخول
            </button>
            <div class="mt-4 text-center">
                <p class="text-sm font-medium text-gray-600">ليس لديك حساب؟ <a href="{{ route('register') }}" class="font-bold text-black border-b border-black pb-0.5 hover:bg-black hover:text-white transition-all">ابدا بانشاء حساب الان</a></p>
            </div>
        </div>
    </form>
</x-guest-layout>