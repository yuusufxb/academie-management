@extends('layouts.admin')
@section('title','تفاصيل القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
  <h2 class="font-headline text-xl font-black text-[#0f2b26]">
    {{ $press['title'] ?? 'أكادير: لقاء تواصلي حول المنصة الرقمية الجهوية «أنشطتي»' }}
  </h2>
  <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-3xl space-y-4" dir="rtl">
  <div class="bg-white rounded-md shadow-sm overflow-hidden border border-slate-100">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
      <div class="flex items-center gap-2">
        <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
        <h3 class="font-headline font-black text-sm text-[#0f2b26]">تفاصيل الصحفية</h3>
      </div>
      <a href="{{ route('admin.press.edit', $press['id'] ?? 1) }}"
         class="px-3 py-1 border border-slate-200 text-slate-600 text-xs font-bold rounded-md hover:bg-white hover:text-[#10b981] transition-all">تحرير</a>
    </div>

    <div class="divide-y divide-slate-50">
      {{-- Grouped Alignment: Label and Value on the right --}}
      <div class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">عنوان الصحيفة :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right leading-relaxed">{{ $press['title'] ?? 'أكادير: لقاء تواصلي حول المنصة الرقمية الجهوية «أنشطتي»' }}</p>
      </div>

      <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">تاريخ الصحيفة :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right italic">{{ $press['publish_date'] ?? '2024-04-16' }}</p>
      </div>

      <div class="flex items-center px-5 py-3 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">رابط المقال :</p>
        <div class="flex-1 text-right">
            <a href="{{ $press['url'] ?? '#' }}" class="text-[#10b981] text-sm font-bold hover:underline">اضغط هنا لعرض المقال</a>
        </div>
      </div>
    </div>

    {{-- Article body --}}
    <div class="px-5 py-5 border-t border-slate-100 bg-slate-50/10">
      <p class="font-headline text-[#0f2b26] text-sm font-black text-right mb-3">المقال :</p>
      <p class="text-slate-700 text-sm leading-relaxed text-right font-medium">
        {{ $press['content'] ?? 'انطلقت يوم الاثنين 15 ابريل 2024 بالمركز الجهوي للتكوين المستمر محمد الزرقطوني بأكادير، اللقاءات التواصلية لتعميم استعمال المنصة الرقمية الجهوية «أنشطتي» لتتبع الأنشطة والمبادرات التربوية، بحضور مديرات ومديري المؤسسات التعليمية بالمديرية الإقليمية بأكادير ادوتنان.' }}
      </p>
    </div>

    <div class="px-5 py-4 border-t border-slate-100 flex justify-end bg-slate-50/30">
      <a href="{{ route('admin.press.edit', $press['id'] ?? 1) }}"
         class="px-6 py-2 bg-[#0f2b26] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
        تعديل التفاصيل
      </a>
    </div>
  </div>
</div>
@endsection