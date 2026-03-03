<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-black tracking-tighter mb-2">إنشاء حساب</h2>
        <p class="text-gray-600 font-medium text-sm">ابدأ الآن في استخدام نظام سحاب مجاناً.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-bold text-sm text-black mb-1">الاسم الكامل</label>
            <input id="name" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-bold text-sm text-black mb-1">البريد الإلكتروني</label>
            <input id="email" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-bold text-sm text-black mb-1">كلمة المرور</label>
            <input id="password" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="password" name="password" required autocomplete="new-password" />
            @error('password')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-bold text-sm text-black mb-1">تأكيد كلمة المرور</label>
            <input id="password_confirmation" class="block w-full border-2 border-black px-4 py-2 focus:ring-0 focus:border-black transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-black text-white font-bold text-base px-8 py-3 hover:bg-white hover:text-black border-2 border-black transition-all">
                إنشاء الحساب
            </button>
            <div class="mt-4 text-center">
                <p class="text-sm font-medium text-gray-600">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="font-bold text-black border-b border-black pb-0.5 hover:bg-black hover:text-white transition-all">تسجيل الدخول</a></p>
            </div>
        </div>
    </form>
</x-guest-layout>