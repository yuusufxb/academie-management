@extends('layouts.admin')
@section('title','تفاصيل الرسالة')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <h2 class="font-headline text-xl font-black text-[#0f2b26]">
        {{ $message['subject'] ?? 'طلب كيفية ادخال الصور للانشطة' }}
    </h2>
    <a href="{{ route('admin.messages') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-2xl" dir="rtl">
    <div class="bg-white rounded-md shadow-sm overflow-hidden border border-slate-100">

        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/30">
            <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
            <h3 class="font-headline font-black text-sm text-[#0f2b26]">تفاصيل</h3>
        </div>

        <div class="divide-y divide-slate-50">

            {{-- FIXED ALIGNMENT: Labels and Values are now grouped to the right --}}
            <div class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[120px] ml-6">عنوان :</p>
                <p class="text-slate-800 text-sm font-medium flex-1 text-right leading-relaxed">
                    {{ $message['subject'] ?? 'طلب كيفية ادخال الصور للانشطة' }}
                </p>
            </div>

            <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[120px] ml-6">المرسل :</p>
                <div class="flex-1 text-right">
                    <span class="bg-[#10b981] text-white text-xs font-black px-3 py-1 rounded-full">
                        {{ $message['sender'] ?? 'مدير مدرسة اكيدار الجديدة' }}
                    </span>
                </div>
            </div>

            <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[120px] ml-6">البريد الإلكتروني :</p>
                <p class="text-slate-800 text-sm text-right flex-1">{{ $message['email'] ?? 'majidpolitique@gmail.com' }}</p>
            </div>

            <div class="flex items-start px-5 py-4 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[120px] ml-6">الرسالة :</p>
                <p class="text-slate-700 text-sm leading-relaxed text-right flex-1 font-medium">
                    {{ $message['body'] ?? 'يشرفني ان طلب منكم كيفية ادخال الصور الخاصة بالانشطة المنجزة بالمؤسسة وشكرا' }}
                </p>
            </div>

            <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[120px] ml-6">تاريخ الإرسال :</p>
                <p class="text-slate-500 text-xs text-right flex-1 italic">{{ $message['created_at'] ?? '2024-10-27 11:45:00' }}</p>
            </div>

        </div>

        <div class="px-5 py-4 border-t border-slate-100 flex justify-end bg-slate-50/50">
            <a href="{{ route('admin.messages') }}"
               class="px-6 py-2 bg-[#0f2b26] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                العودة
            </a>
        </div>
    </div>
</div>
@endsection