@extends('layouts.app')
@section('title', $council['title'] ?? 'تفاصيل المجلس الإداري')

@section('content')
<div class="pt-16 font-sans" style="background:#f8fafc; min-height:100vh" dir="rtl">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- Entire page description as a single large card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Right-Aligned Header Banner (inside the big card) --}}
            <div class="p-8 border-b border-slate-100 text-right"
                 style="background-color: #0f2b26; background-image: linear-gradient(to right, #0f2b26 0%, #12312b 100%);">
                <h1 class="font-headline font-black text-2xl lg:text-3xl text-white leading-tight">
                    {{ $council['title'] ?? 'الدورة العادية للمجلس الإداري لجهة سوس ماسة' }}
                </h1>
            </div>

            {{-- Stacked Sections inside the large card --}}
            <div class="space-y-0 divider-slate-100">

                {{-- Council Details Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div> {{-- Mint green accent --}}
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تفاصيل الدورة</h3>
                    </div>

                    <div class="grid grid-cols-2 divide-x divide-x-reverse divide-[#10b981]/10 border border-slate-100 rounded-2xl overflow-hidden hover:border-[#10b981]/20 transition-all font-headline">
                        @foreach([
                            [['label'=>'عنوان الدورة', 'value'=> $council['title'] ?? 'الدورة العادية للمجلس الإداري'],
                             ['label'=>'تاريخ الانعقاد','value'=> $council['date'] ?? '2023-12-11']],
                            [['label'=>'مكان الانعقاد', 'value'=> $council['place'] ?? 'مقر ولاية جهة سوس ماسة'],
                             ['label'=>'الدورة',        'value'=> $council['session'] ?? 'دجنبر']],
                            [['label'=>'السنة',         'value'=> $council['year'] ?? '2023'],
                             ['label'=>'تاريخ الإضافة', 'value'=> $council['created_at'] ?? '2023-12-12']],
                        ] as $pair)
                            @foreach($pair as $cell)
                            <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors last:border-b-0">
                                <p class="text-slate-400 text-xs mb-1.5">{{ $cell['label'] }}</p>
                                <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $cell['value'] }}</p>
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Report / Decisions Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">التقرير والمقررات</h3>
                    </div>
                    <p class="font-headline text-slate-600 text-base leading-loose text-justify px-2">
                        {{ $council['report'] ?? 'انعقدت الدورة العادية للمجلس الإداري للأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة، حيث تمت المصادقة بالإجماع على مشروعي برنامج العمل والميزانية برسم السنة المالية، إلى جانب مناقشة أهم الإنجازات والتحديات التي تواجه المنظومة التربوية بالجهة وتتويج اللقاء بمجموعة من التوصيات الهامة.' }}
                    </p>
                </div>

                {{-- Photos Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">صور توثيقية</h3>
                    </div>
                    @if(!empty($council['photos']))
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 px-2">
                            @foreach($council['photos'] as $p)
                            <div class="rounded-2xl overflow-hidden aspect-square bg-slate-100 border border-slate-200 group cursor-pointer shadow-sm hover:shadow-md transition-shadow">
                                <img src="{{ asset('storage/'.$p) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"/>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 px-2">
                            @foreach(range(1,4) as $i)
                            <div class="rounded-2xl bg-slate-50 border border-slate-100 aspect-square flex items-center justify-center hover:border-[#10b981]/20 transition-all">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Main Document / Inspection Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">نسخة التقرير الرسمي</h3>
                    </div>
                    <div class="px-2">
                        @if(!empty($council['image']))
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 group shadow-lg hover:border-[#10b981]/40 transition-all">
                                <img src="{{ asset('storage/'.$council['image']) }}" class="w-full object-cover transition-all group-hover:scale-[1.01]"/>
                            </div>
                        @else
                            <div class="w-full h-56 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center hover:border-[#10b981]/20 transition-all">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Footer credit section inside the big card --}}
                <div class="p-8 text-center bg-slate-50 border-t border-slate-100">
                    <p class="font-headline text-[#0f2b26] text-sm font-bold mb-1.5">مصلحة التواصل وتتبع أشغال المجلس الإداري</p>
                    <p class="font-headline text-[#10b981] text-xs font-semibold tracking-wide">الأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection