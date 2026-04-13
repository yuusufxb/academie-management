@extends('layouts.admin')
@section('title', 'لوحة التتبع')
@section('page-title', 'لوحة التتبع')

@section('content')
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

<div class="grid grid-cols-4 gap-4 mb-6">
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">school</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">{{ $stats['councils'] ?? 58 }}</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">الأكاديمية</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">folder_open</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">{{ $stats['reports'] ?? 68 }}</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">المديريات</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">domain</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">{{ $stats['messages'] ?? 442 }}</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">المؤسسات</p></div>
  </div>
  <div class="bg-surface-container-lowest p-6 rounded-md flex flex-col justify-between h-40 group hover:bg-primary transition-colors duration-300 cursor-pointer">
    <span class="material-symbols-outlined text-secondary text-3xl group-hover:text-secondary-fixed">bar_chart</span>
    <div><p class="text-2xl font-headline font-bold text-primary group-hover:text-white">{{ $stats['activities'] ?? 568 }}</p><p class="text-on-surface-variant text-xs group-hover:text-slate-300">مجموع الأنشطة</p></div>
  </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-4">
  <div class="col-span-2 bg-surface-container-lowest rounded-md overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
      <h3 class="font-headline font-bold text-base">📋 تتبع الأنشطة</h3>
      <a href="{{ route('admin.activities.index') }}" class="text-secondary text-xs font-bold font-label hover:underline">عرض الكل ←</a>
    </div>
    
    @php
      // مصفوفة الألوان الأصلية الخاصة بك ليتم توزيعها على الأسطر
      $badgeColors = [
          ['bg' => '#ccfbf1', 'text' => '#0f766e'],
          ['bg' => '#ede9fe', 'text' => '#6d28d9'],
          ['bg' => '#fef3c7', 'text' => '#b45309'],
          ['bg' => '#fee2e2', 'text' => '#b91c1c'],
          ['bg' => '#dcfce7', 'text' => '#166534'],
      ];
      $respColors = [
          ['bg' => '#dbeafe', 'text' => '#1d4ed8'],
          ['bg' => '#dcfce7', 'text' => '#166534'],
          ['bg' => '#f1f5f9', 'text' => '#64748b'],
      ];
      
      // مصفوفة لتحويل الأرقام إلى نصوص (عدّل الأسماء حسب ما يقابله الرقم في نظامك)
      $typeNames = [
          1 => 'احتفال',
          2 => 'ورشة',
          3 => 'نشاط آخر',
          4 => 'لقاء',
          5 => 'مسابقة',
          6 => 'رياضة'
      ];
    @endphp

    <table class="data-table">
      <thead><tr><th>رت</th><th>عنوانه</th><th>نوع النشاط</th><th>تاريخه</th><th>المسؤول</th></tr></thead>
      <tbody>
        @forelse($latestActivities as $index => $activity)
          @php
            // اختيار لون مختلف لكل سطر بناءً على التصميم الأصلي
            $bColor = $badgeColors[$index % count($badgeColors)];
            $rColor = $respColors[$index % count($respColors)];
            
            // تحويل الرقم إلى نص، وإذا لم يكن موجوداً نكتب "غير محدد" أو نعرض القيمة نفسها
            $activityTypeName = $typeNames[$activity->typ] ?? $activity->typ;
          @endphp
          <tr>
            <td>{{ $activity->id }}</td>
            <td class="font-bold" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $activity->title }}</td>
            <td><span class="badge" style="background:{{ $bColor['bg'] }};color:{{ $bColor['text'] }}">{{ $activityTypeName }}</span></td>
            <td>{{ $activity->dte }}</td>
            <td><span class="badge" style="background:{{ $rColor['bg'] }};color:{{ $rColor['text'] }};font-size:10px">{{ $activity->resp }}</span></td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">لا توجد بيانات</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  
  <div class="flex flex-col gap-4">
    <div class="bg-surface-container-lowest rounded-md p-4">
      <h3 class="font-headline font-bold text-sm mb-3">🎯 أنواع الأنشطة</h3>
      <div class="space-y-3">
        @php 
            $total = ($stats['activities'] ?? 1) > 0 ? $stats['activities'] : 1; 
            $groupedTypes = \App\Models\Activity::select('typ', \DB::raw('count(*) as count'))
                            ->groupBy('typ')->orderBy('count', 'desc')->take(6)->get();
        @endphp
        
        @foreach($groupedTypes as $type)
          @php
             // تحويل الرقم إلى نص هنا أيضاً
             $typeName = $typeNames[$type->typ] ?? $type->typ;
             $pct = ($type->count / $total) * 100;
          @endphp
          <div class="flex items-center gap-2">
            <span class="w-5 h-5 rounded-full bg-slate-800 text-white text-[9px] font-black flex items-center justify-center flex-shrink-0">{{ $type->count }}</span>
            <span class="text-xs text-slate-600 flex-1">{{ $typeName }}</span>
            <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden"><div class="h-full bg-secondary rounded-full" style="width:{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection