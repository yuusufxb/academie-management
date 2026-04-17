@extends('layouts.app')
@section('title', $initiative->title)

@section('content')
<div class="pt-16 font-sans" style="background:#f8fafc; min-height:100vh" dir="rtl">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- البطاقة الرئيسية الكبيرة --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- رأس الصفحة --}}
            <div class="p-8 border-b border-slate-100 text-right"
                 style="background-color: #0f2b26; background-image: linear-gradient(to right, #0f2b26 0%, #12312b 100%);">
                <div class="flex justify-between items-start">
                    <h1 class="font-headline font-black text-2xl lg:text-3xl text-white leading-tight max-w-4xl">
                        {{ $initiative->title }}
                    </h1>
                    <span class="bg-[#10b981] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mr-4">
                        {{ $initiative->typ ?? 'مبادرة' }}
                    </span>
                </div>
            </div>

            <div class="space-y-0">
                {{-- قسم تفاصيل المبادرة (بطاقة تقنية) --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">بطاقة تقنية للمبادرة</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 border border-slate-100 rounded-2xl overflow-hidden font-headline">
                        {{-- الحقل 1: العنوان --}}
                        <div class="px-6 py-5 border-b border-l border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">عنوان المبادرة</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $initiative->title }}</p>
                        </div>
                        {{-- الحقل 2: المستوى --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">المستوى الاستراتيجي</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $initiative->typ }}</p>
                        </div>
                        {{-- الحقل 3: المؤسسة (من علاقة النشاط) --}}
                        <div class="px-6 py-5 border-b border-l border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">المؤسسة المعنية</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">
                                {{ $initiative->activity->etablissement ?? 'أكاديمية سوس ماسة' }}
                            </p>
                        </div>
                        {{-- الحقل 4: التاريخ --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">تاريخ الإدراج</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $initiative->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>

                {{-- قسم التقرير والوصف --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تقرير حول المبادرة</h3>
                    </div>
                    <div class="prose max-w-none">
                        <div class="font-headline text-slate-600 text-base leading-loose text-justify px-2">
                            {!! $initiative->infos !!} 
                        </div>
                    </div>
                </div>

                {{-- قسم الصور المعاينة --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">معاينة المبادرة</h3>
                    </div>
                    
                    <div class="px-2">
                        @if($initiative->tof)
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 group shadow-lg hover:border-[#10b981]/40 transition-all">
                                <img src="{{ photo_asset($initiative->tof) }}" class="w-full h-auto object-cover" alt="{{ $initiative->title }}"/>
                            </div>
                        @else
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-8 flex flex-col items-center">
                                <span class="material-symbols-outlined text-slate-300 text-6xl mb-2">image_not_supported</span>
                                <p class="text-slate-400 text-xs">لا توجد صور متوفرة لهذه المبادرة</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- التذييل --}}
                <div class="p-8 text-center bg-slate-50 border-t border-slate-100">
                    <p class="font-headline text-[#0f2b26] text-sm font-bold mb-1.5">مصلحة التواصل وتتبع أشغال المجلس الإداري</p>
                    <p class="font-headline text-[#10b981] text-xs font-semibold tracking-wide">الأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة</p>
                </div>

            </div>
        </div>

        {{-- زر العودة --}}
        <div class="mt-8 flex justify-center">
            <a href="{{ route('initiatives') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-full font-bold hover:bg-slate-50 transition-all shadow-sm">
                <span class="material-symbols-outlined">arrow_forward</span>
                العودة لقائمة المبادرات
            </a>
        </div>

    </div>
</div>
@endsection