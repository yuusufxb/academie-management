@extends('layouts.admin')
@section('title','تفاصيل الفيديو')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
  <h2 class="font-headline text-xl font-black text-[#0f2b26]">
    {{ $video['title'] ?? 'مراسيم حفل تتويج الفائزات والفائزين بجائزة استاذ(ة) السنة في نسختها الثالثة.' }}
  </h2>
  <a href="{{ route('admin.videos') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-3xl space-y-4" dir="rtl">
  <div class="bg-white rounded-md shadow-sm overflow-hidden border border-slate-100">
    
    {{-- Card Header --}}
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
      <div class="flex items-center gap-2">
        <span class="w-7 h-7 bg-[#10b981]/10 border border-[#10b981]/20 text-[#10b981] rounded-md flex items-center justify-center text-xs font-black italic">i</span>
        <h3 class="font-headline font-black text-sm text-[#0f2b26]">تفاصيل</h3>
      </div>
      <a href="{{ route('admin.videos.edit', $video['id'] ?? 1) }}"
         class="px-3 py-1 border border-slate-200 text-slate-600 text-xs font-bold rounded-md hover:bg-white hover:text-[#10b981] transition-all">تحرير</a>
    </div>

    <div class="divide-y divide-slate-50">
      {{-- Grouped Alignment: Label and Value --}}
      <div class="flex items-start px-5 py-4 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">عنوان الفيديو :</p>
        <p class="text-slate-800 text-sm font-medium flex-1 text-right leading-relaxed">
            {{ $video['title'] ?? 'مراسيم حفل تتويج الفائزات والفائزين بجائزة استاذ(ة) السنة في نسختها الثالثة.' }}
        </p>
      </div>

      <div class="flex items-center px-5 py-4 hover:bg-slate-50 transition-colors">
        <p class="font-headline text-[#0f2b26] text-sm font-black text-right min-w-[140px] ml-6">النظام / الموقع :</p>
        <div class="flex-1 text-right">
            <span class="bg-[#10b981] text-white text-[10px] font-black px-3 py-1 rounded-md uppercase tracking-wider">
                {{ $video['platform'] ?? 'Facebook' }}
            </span>
        </div>
      </div>
    </div>

    {{-- Video Player Section --}}
    <div class="px-5 py-6 border-t border-slate-100 bg-slate-50/10">
      <p class="font-headline text-[#0f2b26] text-sm font-black text-right mb-4">عرض :</p>
      <div class="aspect-video w-full rounded-xl overflow-hidden bg-black shadow-inner border border-slate-200">
          {{-- Replace this div with your actual video iframe or player --}}
          @if(isset($video['embed_code']))
            {!! $video['embed_code'] !!}
          @else
            <div class="w-full h-full flex items-center justify-center text-slate-500 flex-col gap-2">
                <span class="material-symbols-outlined text-5xl opacity-20">play_circle</span>
                <span class="text-xs font-bold">لا يوجد فيديو للمعاينة</span>
            </div>
          @endif
      </div>
    </div>

    {{-- Footer Info & Action --}}
    <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/30">
      <div class="text-right">
          <p class="font-headline text-[#0f2b26] text-sm font-black mb-1">تاريخ الإضافة :</p>
          <p class="text-slate-500 text-xs font-bold italic">{{ $video['created_at'] ?? '2022-04-02 12:17:02' }}</p>
      </div>
      <a href="{{ route('admin.videos.edit', $video['id'] ?? 1) }}"
         class="px-6 py-2.5 bg-[#0f2b26] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
        تعديل التفاصيل
      </a>
    </div>
  </div>
</div>
@endsection