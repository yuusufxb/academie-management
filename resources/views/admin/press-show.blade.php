@extends('layouts.admin')
@section('title','تفاصيل القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
  <h2 class="font-headline text-xl font-black text-[#0f2b26]">
    {{ $clipping->titre }}
  </h2>
  <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-3xl space-y-4" dir="rtl">
  <div class="bg-white rounded-md shadow-sm overflow-hidden border border-slate-100 text-right">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
      <div class="flex items-center gap-2">
        <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
        <h3 class="font-headline font-black text-sm text-[#0f2b26]">تفاصيل الصحفية</h3>
      </div>
      <a href="{{ route('admin.press.edit', $clipping->id) }}"
         class="px-3 py-1 border border-slate-200 text-slate-600 text-xs font-bold rounded-md hover:bg-white hover:text-[#10b981] transition-all">تحرير</a>
    </div>

    <div class="divide-y divide-slate-50">
      {{-- المنبر الإعلامي --}}
      <div class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">المنبر الإعلامي :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right leading-relaxed">{{ $clipping->journal }}</p>
      </div>

      {{-- عنوان المقال --}}
      <div class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">عنوان المقال :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right leading-relaxed">{{ $clipping->titre }}</p>
      </div>

      {{-- تاريخ الصحيفة --}}
      <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">تاريخ النشر :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right italic">{{ $clipping->dte }}</p>
      </div>

      {{-- رابط المقال --}}
      <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">رابط المقال :</p>
        <div class="flex-1 text-right">
            @if($clipping->lien)
                <a href="{{ $clipping->lien }}" target="_blank" class="text-[#10b981] text-sm font-bold hover:underline">اضغط هنا لعرض المقال الخارجي</a>
            @else
                <span class="text-slate-400 text-sm italic">لا يوجد رابط متوفر</span>
            @endif
        </div>
      </div>
    </div>

    {{-- نص المقال --}}
    <div class="px-5 py-5 border-t border-slate-100 bg-slate-50/10 text-right">
      <p class="font-headline text-[#0f2b26] text-sm font-black text-right mb-3">محتوى المقال :</p>
      <div class="text-slate-700 text-sm leading-relaxed text-right font-medium whitespace-pre-line">
        {{ $clipping->txt ?? 'لا يوجد نص مضاف لهذا المقال.' }}
      </div>
    </div>

    {{-- صورة المقال (اختياري إذا كانت موجودة) --}}
    @if($clipping->photo)
    <div class="px-5 py-5 border-t border-slate-100 text-right">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right mb-3">صورة القصاصة :</p>
        <img src="{{ asset('storage/' . $clipping->photo) }}" class="max-w-full h-auto rounded-md shadow-sm border border-slate-100">
    </div>
    @endif

    <div class="px-5 py-4 border-t border-slate-100 flex justify-end bg-slate-50/30">
      <a href="{{ route('admin.press.edit', $clipping->id) }}"
         class="px-6 py-2 bg-[#0f2b26] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
        تعديل التفاصيل
      </a>
    </div>
  </div>
</div>
@endsection