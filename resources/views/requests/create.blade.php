<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('requests.index') }}" class="text-black hover:opacity-70 transition-opacity">
                <svg class="w-6 h-6 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-black text-2xl text-black leading-tight">
                إنشاء طلب جديد
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block font-bold text-sm text-black mb-2">عنوان الطلب</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full border-2 border-black px-4 py-3 text-sm focus:ring-0 focus:border-black transition-colors" placeholder="اكتب عنواناً يصف طلبك باختصار..." required>
                        @error('title')
                        <p class="text-red-600 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block font-bold text-sm text-black mb-2">التفاصيل</label>
                        <textarea name="description" id="description" rows="5" class="block w-full border-2 border-black px-4 py-3 text-sm focus:ring-0 focus:border-black transition-colors resize-none" placeholder="اشرح لنا المشكلة أو الطلب بالتفصيل..." required>{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-600 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-end gap-4">
                        <a href="{{ route('requests.index') }}" class="px-6 py-3 font-bold text-sm border-2 border-transparent hover:border-black transition-colors">إلغاء</a>
                        <button type="submit" class="bg-black text-white font-bold text-sm px-8 py-3 border-2 border-black hover:bg-white hover:text-black transition-colors">
                            إرسال الطلب
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>