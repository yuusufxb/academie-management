@extends('layouts.admin')
@section('title', 'لوحة التتبع')
@section('page-title', 'لوحة التتبع')

@section('content')
<!-- Banner -->
<div class="rounded-xl p-7 mb-6 flex items-center justify-between relative overflow-hidden" style="background:linear-gradient(135deg,#000000 0%,#101b30 100%)">
  <div class="z-10">
    <h2 class="font-headline text-2xl font-black text-white mb-1">مرحباً بك، {{ auth()->user()->name ?? 'Stagaire' }}</h2>
    <p class="text-white/50 text-sm font-label">منصة تتبع الأنشطة — الأكاديمية الجهوية لسوس ماسة</p>
  </div>
  <div class="flex gap-3 z-10">
    <button class="border border-white/20 text-white/80 px-5 py-2 rounded-md text-sm font-bold font-label hover:bg-white/10 transition-all active:scale-95">📤 تصدير تقرير</button>
    <a href="{{ route('admin.activities.create') }}" class="bg-emerald-500 text-white px-5 py-2 rounded-md text-sm font-bold font-label hover:bg-emerald-400 active:scale-95 transition-all">+ إضافة نشاط جديد</a>
  </div>
</div>

<!-- KPIs -->
<div class="grid grid-cols-4 gap-4 mb-6">
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">school</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">58</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">الأكاديمية</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">folder_open</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">68</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">المديريات</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">domain</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">442</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">المؤسسات</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">bar_chart</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">568</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">مجموع الأنشطة</p></div>
  </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-3 gap-4 mb-4">
  <!-- Activities Table -->
  <div class="col-span-2 bg-surface-container-lowest rounded-md overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 class="font-headline font-bold text-base">📋 تتبع الأنشطة</h3>
      <a href="{{ route('admin.activities.index') }}" class="text-secondary text-xs font-bold font-label hover:underline">عرض الكل ←</a>
    </div>
    <table class="data-table">
      <thead><tr><th>رت</th><th>عنوانه</th><th>نوع النشاط</th><th>تاريخه</th><th>المسؤول</th></tr></thead>
      <tbody>
        <tr><td>568</td><td class="font-bold">احتفال</td><td><span class="badge" style="background:#ccfbf1;color:#0f766e">احتفال</span></td><td>2026-02-28</td><td><span class="badge" style="background:#dbeafe;color:#1d4ed8;font-size:10px">Mohammed alt id</span></td></tr>
        <tr><td>567</td><td class="font-bold" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">توعية التلاميذ بالحقوق</td><td><span class="badge" style="background:#ede9fe;color:#6d28d9">ورشة</span></td><td>2024-12-31</td><td><span class="badge" style="background:#dcfce7;color:#166534;font-size:10px">رقية أجرازي</span></td></tr>
        <tr><td>566</td><td class="font-bold" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">تحسيس التلاميذ بالبيئة</td><td><span class="badge" style="background:#fef3c7;color:#b45309">نشاط آخر</span></td><td>2024-12-07</td><td><span class="badge" style="background:#f1f5f9;color:#64748b;font-size:10px">المنسق الثاني</span></td></tr>
        <tr><td>565</td><td class="font-bold">تأسيس نادي القراءة</td><td><span class="badge" style="background:#fee2e2;color:#b91c1c">لقاء</span></td><td>2024-12-25</td><td><span class="badge" style="background:#dbeafe;color:#1d4ed8;font-size:10px">الحسن أسكوي</span></td></tr>
        <tr><td>564</td><td class="font-bold" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">المسابقة النهائية للسيرة</td><td><span class="badge" style="background:#dcfce7;color:#166534">مسابقة</span></td><td>2024-12-28</td><td><span class="badge" style="background:#dcfce7;color:#166534;font-size:10px">الأستاذ مصطفى</span></td></tr>
      </tbody>
    </table>
  </div>
  <!-- Activity Types -->
  <div class="flex flex-col gap-4">
    <div class="bg-surface-container-lowest rounded-md p-4">
      <h3 class="font-headline font-bold text-sm mb-3">🎯 أنواع الأنشطة</h3>
      <div class="space-y-3">
        @php $types = [['احتفال',170,90],['نشاط آخر',125,66],['لقاء',63,33],['مسابقة',52,27],['رياضة',42,22],['ورشة',36,19]]; @endphp
        @foreach($types as [$name,$count,$pct])
          <div class="flex items-center gap-2">
            <span class="w-5 h-5 rounded-full bg-slate-800 text-white text-[9px] font-black flex items-center justify-center flex-shrink-0">{{ $count }}</span>
            <span class="text-xs text-slate-600 flex-1">{{ $name }}</span>
            <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden"><div class="h-full bg-secondary rounded-full" style="width:{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
