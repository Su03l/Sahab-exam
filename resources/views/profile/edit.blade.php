<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-black leading-tight">
            الملف الشخصي
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'profile-updated')
            <div class="bg-white border-2 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm font-bold flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-black"></span>
                تم تحديث الملف الشخصي بنجاح.
            </div>
            @endif

            <div class="bg-white border-2 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="mb-6 border-b-2 border-black pb-4">
                    <h3 class="text-xl font-black">معلومات الحساب</h3>
                    <p class="text-gray-600 text-sm font-medium">قم بتحديث معلومات الحساب الخاصة بك مثل الاسم والبريد الإلكتروني.</p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block font-bold text-sm text-black mb-2">الاسم</label>
                        <input id="name" name="name" type="text" class="block w-full border-2 border-black px-4 py-3 text-sm focus:ring-0 focus:border-black transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @error('name')
                        <p class="text-red-600 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block font-bold text-sm text-black mb-2">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" class="block w-full border-2 border-black px-4 py-3 text-sm focus:ring-0 focus:border-black transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @error('email')
                        <p class="text-red-600 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="bg-black text-white font-bold text-sm px-8 py-3 border-2 border-black hover:bg-white hover:text-black transition-colors">
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password and Delete Account sections omitted for standard minimalist flow unless needed. -->

        </div>
    </div>
</x-app-layout>