{{-- @extends('layouts.admin')
@section('title', 'وحدة التحكم')
@section('page-title', 'وحدة التحكم')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">وحدة التحكم — إدارة العلامات المائية</h2>
  <button class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">معالجة جميع الصور</button>
</div>
<div class="bg-surface-container-lowest rounded-md p-5 mb-4">
  <div class="flex gap-8 mb-4">
    <div><span class="text-sm text-slate-500">إجمالي الصور:</span> <strong class="text-xl font-headline text-slate-900">2292</strong></div>
    <div><span class="text-sm text-slate-500">عدد الأنشطة:</span> <strong class="text-xl font-headline text-slate-900">568</strong></div>
  </div>
  <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">الصور الأخيرة</p>
  <div class="photo-grid">
    @foreach(range(1,4) as $i)
      <div class="bg-white border border-slate-100 rounded-md overflow-hidden">
        <div class="photo-thumb"><span class="material-symbols-outlined text-slate-300">image</span></div>
        <div class="p-2">
          <p class="text-[11px] text-slate-500 mb-1">نشاط: غير معروف</p>
          <button class="bg-secondary text-white text-[11px] font-bold px-2 py-0.5 rounded-md">معالجة</button>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection --}}
