<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-black leading-tight">
                الطلبات
            </h2>
            <a href="{{ route('requests.create') }}" class="bg-black text-white font-bold px-6 py-2 border-2 border-black hover:bg-white hover:text-black transition-colors text-sm">
                تقديم طلب جديد
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
            <div class="bg-white border-2 border-black p-4 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm font-bold flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-black"></span>
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="p-6 border-b-2 border-black bg-white">
                    <h3 class="font-black text-xl">قائمة الطلبات</h3>
                    <p class="text-sm font-medium text-gray-600">عرض وإدارة الطلبات الحالية في النظام.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b-2 border-black bg-gray-50 text-sm font-black uppercase">
                                <th class="p-4">رقم #</th>
                                <th class="p-4">العنوان</th>
                                <th class="p-4">الموظف</th>
                                <th class="p-4">التاريخ</th>
                                <th class="p-4">الحالة</th>
                                @if (Auth::user()->role === \App\Enums\UserRole::MANAGER)
                                <th class="p-4 text-center">الإجراءات</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $request)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-bold">#{{ $request->id }}</td>
                                <td class="p-4">
                                    <div class="font-bold mb-1">{{ $request->title }}</div>
                                    <div class="text-xs text-gray-600 truncate max-w-xs">{{ $request->description }}</div>
                                </td>
                                <td class="p-4 text-sm font-bold">{{ $request->user->name ?? 'غير معروف' }}</td>
                                <td class="p-4 text-sm font-bold">{{ $request->created_at->format('Y-m-d') }}</td>
                                <td class="p-4">
                                    @if ($request->status === \App\Enums\RequestStatus::PENDING)
                                    <span class="inline-block px-3 py-1 bg-white border border-black text-xs font-bold uppercase tracking-wider">قيد الانتظار</span>
                                    @elseif ($request->status === \App\Enums\RequestStatus::APPROVED)
                                    <span class="inline-block px-3 py-1 bg-black text-white text-xs font-bold uppercase tracking-wider">مقبول</span>
                                    @elseif ($request->status === \App\Enums\RequestStatus::REJECTED)
                                    <span class="inline-block px-3 py-1 bg-white border-2 border-black text-xs font-bold uppercase tracking-wider line-through decoration-2">مرفوض</span>
                                    @endif
                                </td>
                                @if (Auth::user()->role === \App\Enums\UserRole::MANAGER)
                                <td class="p-4 text-center">
                                    @if ($request->status === \App\Enums\RequestStatus::PENDING)
                                    <div class="flex items-center justify-center gap-2 text-sm font-bold">
                                        <form action="{{ route('requests.update-status', $request->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="border-b border-transparent hover:border-black transition-colors px-1">قبول</button>
                                        </form>
                                        <span>|</span>
                                        <form action="{{ route('requests.update-status', $request->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="border-b border-transparent hover:border-black transition-colors px-1">رفض</button>
                                        </form>
                                    </div>
                                    @else
                                    <span class="text-xs font-bold text-gray-400">مكتمل</span>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === \App\Enums\UserRole::MANAGER ? '6' : '5' }}" class="p-8 text-center text-sm font-bold text-gray-500">
                                    لا توجد طلبات حالياً
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>