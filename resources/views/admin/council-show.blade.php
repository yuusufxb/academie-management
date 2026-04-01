@extends('layouts.admin')
@section('title','تفاصيل المجلس الإداري')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header: Aligned with home page style --}}
<div class="flex items-center justify-between mb-6" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            {{ ($session['session'] ?? 'دجنبر').' '.($session['year'] ?? '2018') }}
        </h2>
    </div>
    <a href="{{ route('admin.council') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl space-y-5" dir="rtl">
    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Card Header --}}
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تفاصيل المجلس</h3>
            </div>
            <a href="{{ route('admin.council.edit', $session['id'] ?? 1) }}"
               class="px-3 py-1 border border-slate-200 text-slate-600 text-xs font-bold rounded-md hover:bg-white hover:text-[#10b981] transition-all">تحرير</a>
        </div>

        {{-- Details: Corrected Alignment (Label and Value grouped together) --}}
        <div class="divide-y divide-slate-50">
            <div class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black min-w-[140px] text-right ml-4">دورة المجلس :</p>
                <p class="text-slate-700 text-sm font-medium flex-1 text-right">{{ ($session['session'] ?? 'دجنبر').' - '.($session['year'] ?? '2018') }}</p>
            </div>
            <div class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black min-w-[140px] text-right ml-4">تاريخ المجلس :</p>
                <p class="text-slate-700 text-sm font-medium flex-1 text-right">{{ $session['date'] ?? '2017-12-11' }}</p>
            </div>
            <div class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                <p class="font-headline text-[#0f2b26] text-sm font-black min-w-[140px] text-right ml-4">مكان عقده :</p>
                <p class="text-slate-700 text-sm font-medium flex-1 text-right">{{ $session['place'] ?? 'مقر ولاية جهة سوس ماسة' }}</p>
            </div>
        </div>

        {{-- Report Section --}}
        <div class="px-6 py-5 border-t border-slate-100 bg-slate-50/30">
            <div class="flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-[#10b981] text-lg">description</span>
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right">تقرير :</p>
            </div>
            <p class="text-slate-600 text-sm leading-loose text-right font-medium">
                {{ $session['report'] ?? 'المصادقة بالاجماع على مشروعي برنامج العمل والميزانية برسم السنة المالية 2018 في دورة المجلس الاداري للأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة.' }}
            </p>
        </div>

        {{-- Photo Section --}}
        <div class="px-6 pb-6 border-t border-slate-100 pt-5">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-[#10b981] text-lg">image</span>
                <p class="font-headline text-[#0f2b26] text-sm font-black text-right">صورة المجلس :</p>
            </div>
            @if(!empty($session['image']))
                <div class="rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                    <img src="{{ asset('storage/'.$session['image']) }}" class="w-full object-cover max-h-80 hover:scale-[1.01] transition-transform duration-300"/>
                </div>
            @else
                <div class="w-full h-44 bg-slate-50 border border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-slate-300 text-5xl mb-2">image_not_supported</span>
                    <span class="text-slate-400 text-xs font-bold font-headline">لا توجد صورة متوفرة</span>
                </div>
            @endif
        </div>

        {{-- Footer/Actions --}}
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/50">
            <p class="text-slate-500 text-xs">
                <span class="font-black font-headline text-[#0f2b26] ml-1">تاريخ الإضافة :</span> {{ $session['created_at'] ?? '2022-04-02 11:56:37' }}
            </p>
            <a href="{{ route('admin.council.edit', $session['id'] ?? 1) }}"
               class="px-5 py-2 bg-[#0f2b26] text-white rounded-lg text-xs font-black hover:bg-[#1a423b] transition-all shadow-sm active:scale-95">
                تعديل التفاصيل
            </a>
        </div>
    </div>
</div>
@endsection