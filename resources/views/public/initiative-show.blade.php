@extends('layouts.app')
@section('title', $initiative['title'] ?? 'تفاصيل المبادرة الجهوية')

@section('content')
<div class="pt-16 font-sans" style="background:#f8fafc; min-height:100vh" dir="rtl">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- البطاقة الرئيسية الكبيرة --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- رأس الصفحة - الشريط العلوي الأخضر الداكن --}}
            <div class="p-8 border-b border-slate-100 text-right"
                 style="background-color: #0f2b26; background-image: linear-gradient(to right, #0f2b26 0%, #12312b 100%);">
                <div class="flex justify-between items-start">
                    <h1 class="font-headline font-black text-2xl lg:text-3xl text-white leading-tight max-w-4xl">
                        {{ $initiative['title'] ?? 'م.م ابن عباد بطل المسابقة الإقليمية للبرمجة بلغة سكراتش' }}
                    </h1>
                    <span class="bg-[#10b981] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mr-4">
                        {{ $initiative['level'] ?? 'جهوي' }}
                    </span>
                </div>
            </div>

            {{-- الأقسام المكدسة داخل البطاقة --}}
            <div class="space-y-0 divider-slate-100">

                {{-- قسم تفاصيل المبادرة (Grid) --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">بطاقة تقنية للمبادرة</h3>
                    </div>

                    <div class="grid grid-cols-2 divide-x divide-x-reverse divide-[#10b981]/10 border border-slate-100 rounded-2xl overflow-hidden hover:border-[#10b981]/20 transition-all font-headline">
                        @foreach([
                            [['label'=>'عنوان المبادرة', 'value'=> $initiative['title'] ?? 'زيارة تفقدية لمركز ثانوية أنوال التأهيلية'],
                             ['label'=>'المستوى الاستراتيجي','value'=> $initiative['level'] ?? 'جهوي']],
                            [['label'=>'المؤسسة المعنية', 'value'=> $initiative['school'] ?? 'مجموعة مدارس ابن عباد'],
                             ['label'=>'تاريخ الإدراج',  'value'=> $initiative['date'] ?? '2024-10-05']],
                            [['label'=>'المجال التربوي', 'value'=> $initiative['category'] ?? 'البرمجة والمعلوماتية'],
                             ['label'=>'النظام / الموقع', 'value'=> $initiative['platform'] ?? 'بوابة الأنشطة']],
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

                {{-- قسم التقرير والوصف --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تقرير حول المبادرة</h3>
                    </div>
                    <div class="prose max-w-none">
                        <p class="font-headline text-slate-600 text-base leading-loose text-justify px-2">
                            {{ $initiative['report'] ?? 'في إطار مواكبة الأنشطة التربوية المتميزة بالجهة، حققت المؤسسة نتائج باهرة في المسابقة الإقليمية للبرمجة. تهدف هذه المبادرة إلى تعزيز مهارات التفكير المنطقي والبرمجي لدى المتعلمين، وتنديداً بالدور الريادي الذي تلعبه الأكاديمية الجهوية في دعم التحول الرقمي بالمنظومة التربوية.' }}
                        </p>
                    </div>
                </div>

                {{-- قسم الصور (كما في صورة المعاينة) --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">معاينة المبادرة</h3>
                    </div>
                    
                    <div class="px-2">
                        @if(!empty($initiative['image']))
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 group shadow-lg hover:border-[#10b981]/40 transition-all">
                                <img src="{{ asset('storage/'.$initiative['image']) }}" class="w-full object-cover transition-all group-hover:scale-[1.01]" alt="صورة المبادرة"/>
                            </div>
                        @else
                            {{-- الحالة الافتراضية عند عدم وجود صورة (كما في نموذج ستار9) --}}
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 flex flex-col items-center">
                                <div class="w-full max-w-2xl rounded-xl overflow-hidden shadow-sm border border-slate-200 mb-4">
                                     <img src="https://via.placeholder.com/800x450/f1f5f9/64748b?text=Image+Preview" class="w-full h-auto">
                                </div>
                                <p class="text-slate-400 text-xs">لا توجد صور إضافية متوفرة لهذه المبادرة</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- التذييل الخاص بالمصلحة --}}
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