@extends('layouts.admin')
@section('title','تفاصيل النشاط')
@section('page-title','تتبع الأنشطة')

@section('content')
<div class="font-headline" dir="rtl">
    
    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
            <h2 class="font-black text-xl text-[#0f2b26]">تفاصيل النشاط</h2>
        </div>
        <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
        </a>
    </div>

    <div class="max-w-4xl space-y-5">

        {{-- Main details Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
                    <h3 class="font-black text-sm text-[#0f2b26]">معلومات النشاط</h3>
                </div>
                {{-- تعديل نوع النشاط ليتصل بالعلاقة catigory --}}
                <span class="badge" style="background:#f1f5f9;color:#64748b; padding: 4px 12px; border-radius: 6px; font-weight: bold;">
                    {{ $activity->catigory->caty ?? 'نشاط عام' }}
                </span>
            </div>

            <div class="divide-y divide-slate-50">
                @foreach([
                    ['label'=>'عنوان النشاط :', 'value'=> $activity->title],
                    ['label'=>'تاريخ النشاط :', 'value'=> $activity->dte . ' - ' . $activity->hr],
                    ['label'=>'المستفيدون :',   'value'=> $activity->benfs],
                    ['label'=>'عددهم :',        'value'=> $activity->nb],
                    ['label'=>'مكان النشاط :',   'value'=> $activity->lieu],
                    ['label'=>'المسؤول عن النشاط :', 'value'=> $activity->resp],
                    ['label'=>'مرجع النشاط :', 'value'=> $activity->ref],
                    ['label'=>'تاريخ الإضافة :', 'value'=> $activity->created_at->format('Y-m-d H:i:s')],
                ] as $row)
                <div class="flex items-start px-6 py-4 hover:bg-slate-50 transition-colors">
                    <p class="font-black text-[#0f2b26] text-sm text-right min-w-[160px] ml-6">{{ $row['label'] }}</p>
                    <p class="text-slate-700 text-sm font-medium flex-1 text-right leading-relaxed">{{ $row['value'] ?? '---' }}</p>
                </div>
                @endforeach
            </div>

            <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-end gap-2 flex-wrap bg-slate-50/50">
                <a href="{{ route('admin.activities.edit', $activity->id) }}" class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg text-xs font-bold hover:bg-white transition-all">تعديل التفاصيل</a>
                <a href="{{ route('admin.activities.photos', $activity->id) }}" class="px-4 py-2 border border-[#10b981] text-[#10b981] rounded-lg text-xs font-bold hover:bg-[#10b981] hover:text-white transition-all">إضافة الصور</a>
                <a href="{{ route('admin.activities.report', $activity->id) }}" class="px-4 py-2 bg-[#10b981] text-white rounded-lg text-xs font-bold hover:opacity-90 transition-all">إضافة تقرير</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2 bg-[#0f2b26] text-white rounded-lg text-xs font-bold hover:opacity-90 transition-all">مشاركة على فيسبوك</a>
            </div>
        </div>

        {{-- Report Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-black text-sm text-[#0f2b26]">تقرير النشاط</h3>
                <a href="{{ route('admin.activities.report', $activity->id) }}" class="text-[#10b981] hover:text-[#0f2b26] transition-colors">
                    <span class="material-symbols-outlined text-xl">edit_square</span>
                </a>
            </div>
            <div class="px-5 py-5">
                {{-- استخدام حقل gre بدلاً من نصوص وهمية --}}
                @if(!empty($activity->gre))
                    <p class="text-slate-700 text-sm leading-relaxed text-right font-medium">{{ $activity->gre }}</p>
                @else
                    <div class="bg-slate-50 border border-dashed border-slate-200 rounded-xl px-4 py-8 text-center">
                        <p class="text-slate-500 text-sm font-bold mb-4">لم يتم تحرير أي تقرير بعد لهذا النشاط</p>
                        <a href="{{ route('admin.activities.report', $activity->id) }}" class="px-5 py-2 bg-[#10b981] text-white rounded-lg text-sm font-bold hover:opacity-90 transition-all">إضافة تقرير</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Photos Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-black text-sm text-[#0f2b26]">صور النشاط</h3>
                <span class="material-symbols-outlined text-[#10b981] text-xl">photo_library</span>
            </div>
            <div class="px-5 py-5">
                {{-- استدعاء الصور بشكل صحيح --}}
                @if($activity->photos && count($activity->photos) > 0)
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($activity->photos as $p)
                        <div class="rounded-xl overflow-hidden aspect-video bg-slate-100 border border-slate-100">
                            <img src="{{ asset('storage/'.$p->path) }}" class="w-full h-full object-cover shadow-sm"/>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-slate-50 border border-dashed border-slate-200 rounded-xl px-4 py-8 text-center">
                        <p class="text-slate-500 text-sm font-bold mb-4">لا توجد صور حالياً</p>
                        <a href="{{ route('admin.activities.photos', $activity->id) }}" class="px-5 py-2 bg-[#10b981] text-white rounded-lg text-sm font-bold hover:opacity-90 transition-all">إضافة الصور</a>
                    </div>
                @endif
            </div>
        </div>

    </div>  
</div>
@endsection