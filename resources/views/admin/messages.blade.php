@extends('layouts.admin')
@section('title', 'صندوق الرسائل')
@section('page-title', 'صندوق الرسائل')
@section('content')

<h2 class="font-headline text-xl font-black text-slate-900 mb-4 text-right">تتبع الرسائل الواردة</h2>

<div class="bg-surface-container-lowest rounded-md p-5" dir="rtl">
    {{-- إحصائية ديناميكية للرسائل غير المقروءة --}}
    <p class="font-headline font-black text-lg text-slate-900 mb-4 text-right">
        {{ $messages->where('vu', 0)->count() }} رسالة جديدة من أصل ({{ $messages->total() }})
    </p>

    <div class="divide-y divide-slate-50">
        @forelse($messages as $i => $msg)
            @php
                // تحديد شكل الحالة بناءً على حقل vu (0 = جديد، 1 = مقروء/مسجل)
                $isNew = $msg->vu == 0;
                $statusText = $isNew ? 'جديد' : 'مسجل';
                $statusClass = $isNew ? 'bg-red-100 text-red-600' : 'bg-slate-200 text-slate-600';
                $rowBg = $isNew ? 'bg-red-50/50' : 'bg-white';
            @endphp
            
            <a href="{{ route('admin.messages.show', $msg->id) }}" class="block">
                <div class="flex items-start gap-3 py-3 hover:bg-slate-50 rounded-md px-2 cursor-pointer {{ $rowBg }} transition-colors">
                    <span class="{{ $isNew ? 'text-amber-400' : 'text-slate-300' }}">⭐</span>
                    <div class="flex-1 text-right">
                        <p class="text-sm font-bold text-slate-800">
                            {{ ($messages->currentPage() - 1) * $messages->perPage() + $i + 1 }}. {{ $msg->nom }}
                        </p>
                        <p class="text-xs text-slate-600 mt-0.5">
                            {{ $msg->objet }} — 
                            <span class="text-[10px] {{ $statusClass }} px-1.5 py-0.5 rounded-full font-bold">
                                {{ $statusText }}
                            </span>
                        </p>
                        <p class="text-[11px] text-slate-400 mt-1">
                            {{-- التحقق من وجود مستخدم مرتبطة به الرسالة (buser) --}}
                            @if($msg->user)
                                <span class="ml-2 font-medium text-blue-500">👤 {{ $msg->user->name }}</span>
                            @endif
                            <span class="ltr-text">{{ $msg->created_at->format('Y-m-d H:i') }}</span>
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <div class="py-10 text-center text-slate-400">
                لا توجد رسائل واردة حالياً.
            </div>
        @endforelse
    </div>

    {{-- الترقيم (Pagination) --}}
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>

@endsection