@extends('layouts.app')
@section('title', 'دورة ' . $council->mois . ' ' . $council->yr)

@section('content')
<div class="pt-16 font-sans" style="background:#f8fafc; min-height:100vh" dir="rtl">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- البطاقة الرئيسية الكبيرة --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- رأس الصفحة --}}
            <div class="p-8 border-b border-slate-100 text-right"
                 style="background-color: #0f2b26; background-image: linear-gradient(to right, #0f2b26 0%, #12312b 100%);">
                <h1 class="font-headline font-black text-2xl lg:text-3xl text-white leading-tight">
                    دورة {{ $council->mois }} {{ $council->yr }} للمجلس الإداري
                </h1>
            </div>

            <div class="space-y-0 divider-slate-100">

                {{-- قسم تفاصيل الدورة --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تفاصيل الدورة</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 border border-slate-100 rounded-2xl overflow-hidden hover:border-[#10b981]/20 transition-all font-headline">
                        @php
                            $details = [
                                ['label'=>'مكان الانعقاد', 'value'=> $council->lieu ?? 'مقر ولاية جهة سوس ماسة'],
                                ['label'=>'تاريخ الانعقاد','value'=> $council->dte ?? 'غير محدد'],
                                ['label'=>'الدورة (الشهر)', 'value'=> $council->mois],
                                ['label'=>'السنة المالية', 'value'=> $council->yr],
                                ['label'=>'تاريخ الإدراج بالموقع', 'value'=> $council->created_at->format('Y-m-d')],
                                ['label'=>'الحالة', 'value'=> 'منعقدة مسبقاً'],
                            ];
                        @endphp

                        @foreach($details as $detail)
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors last:border-b-0">
                            <p class="text-slate-400 text-xs mb-1.5">{{ $detail['label'] }}</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $detail['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- قسم التقرير والمقررات --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">التقرير والمقررات</h3>
                    </div>
                    <div class="prose max-w-none">
                        <div class="font-headline text-slate-600 text-base leading-loose text-justify px-2">
                            {!! $council->rap !!}
                        </div>
                    </div>
                </div>

                {{-- قسم الصورة التوثيقية (tof) --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">صورة توثيقية</h3>
                    </div>
                    <div class="px-2">
                        @if($council->tof)
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 group shadow-lg hover:border-[#10b981]/40 transition-all">
                                <img src="{{ photo_asset($council->tof) }}" class="w-full object-cover transition-all group-hover:scale-[1.01]" alt="صورة دورة المجلس"/>
                            </div>
                        @else
                            <div class="w-full h-64 bg-slate-50 border border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center">
                                <span class="material-symbols-outlined text-slate-300 text-6xl mb-2">image_not_supported</span>
                                <p class="text-slate-400 text-sm">لا توجد صور توثيقية لهذه الدورة</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- تذييل البطاقة --}}
                <div class="p-8 text-center bg-slate-50 border-t border-slate-100">
                    <p class="font-headline text-[#0f2b26] text-sm font-bold mb-1.5">مصلحة التواصل وتتبع أشغال المجلس الإداري</p>
                    <p class="font-headline text-[#10b981] text-xs font-semibold tracking-wide">الأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة</p>
                </div>

            </div>
        </div>

        {{-- زر العودة --}}
        <div class="mt-8 flex justify-center">
            <a href="{{ route('council') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-full font-bold hover:bg-slate-50 transition-all shadow-sm">
                <span class="material-symbols-outlined">arrow_forward</span>
                العودة لقائمة الدورات
            </a>
        </div>
    </div>
</div>
@endsection