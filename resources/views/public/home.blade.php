@extends('layouts.app')

@section('title', 'الرئيسية — الأكاديمية الجهوية للتربية والتكوين سوس ماسة')

@section('content')
<section class="relative pt-28 pb-20 px-6 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
  <div class="lg:col-span-7 z-10">
    <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs block mb-4">الأكاديمية الجهوية للتربية والتكوين — جهة سوس ماسة</span>
    <h1 class="font-headline text-primary text-5xl md:text-6xl font-extrabold tracking-tighter leading-tight mb-6">
      منصة إدارة وتتبع<br><span class="text-secondary">الأنشطة المدرسية</span>
    </h1>
    <p class="text-on-surface-variant text-lg md:text-xl max-w-xl mb-10 leading-relaxed">نظام رقمي متكامل لتسجيل الأنشطة شبه المدرسية ومتابعتها والمصادقة عليها — من المؤسسة التعليمية إلى الأكاديمية الجهوية.</p>
    <div class="flex flex-wrap gap-4">
      <a href="{{ route('activities') }}" class="bg-primary text-white px-8 py-4 rounded-md font-headline font-bold text-lg hover:shadow-xl transition-all active:scale-95">استعراض الأنشطة</a>
      <a href="{{ route('login') }}" class="border border-outline-variant text-primary px-8 py-4 rounded-md font-headline font-bold text-lg hover:bg-surface-container-low transition-all">دخول الإدارة</a>
    </div>
  </div>
  <div class="lg:col-span-5 relative">
    <div class="aspect-[4/5] bg-surface-container-high rounded-xl overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
      <div class="w-full h-full bg-gradient-to-br from-slate-800 to-emerald-900 flex flex-col items-center justify-center gap-4 p-8">
        <div class="w-full bg-white/10 rounded-lg p-4 backdrop-blur-sm">
          <p class="text-white/60 text-xs font-label mb-2">لوحة التتبع المحسّنة</p>
          <div class="grid grid-cols-2 gap-2">
            <div class="bg-white/15 rounded-md p-3"><p class="text-emerald-300 font-headline font-black text-2xl">{{ $totalActivities }}</p><p class="text-white/50 text-xs">مجموع الأنشطة</p></div>
            <div class="bg-white/15 rounded-md p-3"><p class="text-emerald-300 font-headline font-black text-2xl">{{ $schoolsCount }}</p><p class="text-white/50 text-xs">المؤسسات</p></div>
            <div class="bg-white/15 rounded-md p-3"><p class="text-emerald-300 font-headline font-black text-2xl">06</p><p class="text-white/50 text-xs">المديريات</p></div>
            <div class="bg-white/15 rounded-md p-3"><p class="text-emerald-300 font-headline font-black text-2xl">91%</p><p class="text-white/50 text-xs">نسبة المصادقة</p></div>
          </div>
        </div>
        <div class="w-full space-y-2">
          @foreach($recent_activities as $act)
          <div class="w-full bg-white/10 rounded-md px-3 py-2 flex justify-between items-center">
            <span class="text-white/70 text-xs">{{ Str::limit($act->title, 30) }}</span>
            <span class="bg-emerald-500/30 text-emerald-300 text-[10px] font-bold px-2 py-0.5 rounded-full">نشط</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="absolute -bottom-6 -right-6 bg-secondary-container p-6 rounded-xl shadow-lg max-w-xs hidden md:block">
      <p class="text-on-secondary-container font-headline font-bold text-2xl mb-1">+{{ number_format($totalActivities) }}</p>
      <p class="text-on-secondary-container/80 text-sm font-medium">نشاط تربوي منجز هذا الموسم الدراسي.</p>
    </div>
  </div>
</section>

<section class="bg-surface-container-low py-24 px-6">
  <div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-12">
      <div><span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">نظرة إحصائية</span><h2 class="font-headline text-primary text-3xl font-bold mt-2">الأثر بالأرقام</h2></div>
      
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="bg-surface-container-lowest p-8 rounded-md flex flex-col justify-between h-48 group hover:bg-primary transition-colors duration-300 cursor-pointer">
        <span class="material-symbols-outlined text-secondary text-4xl group-hover:text-secondary-fixed">school</span>
        <div><p class="text-3xl font-headline font-bold text-primary group-hover:text-white">01</p><p class="text-on-surface-variant text-sm group-hover:text-slate-300">الأكاديمية الجهوية</p></div>
      </div>
      <div class="bg-surface-container-lowest p-8 rounded-md flex flex-col justify-between h-48 group hover:bg-primary transition-colors duration-300 cursor-pointer">
        <span class="material-symbols-outlined text-secondary text-4xl group-hover:text-secondary-fixed">account_balance</span>
        <div><p class="text-3xl font-headline font-bold text-primary group-hover:text-white">06</p><p class="text-on-surface-variant text-sm group-hover:text-slate-300">المديريات الإقليمية</p></div>
      </div>
      <div class="bg-surface-container-lowest p-8 rounded-md flex flex-col justify-between h-48 group hover:bg-primary transition-colors duration-300 cursor-pointer">
        <span class="material-symbols-outlined text-secondary text-4xl group-hover:text-secondary-fixed">domain</span>
        <div><p class="text-3xl font-headline font-bold text-primary group-hover:text-white">{{ $schoolsCount }}</p><p class="text-on-surface-variant text-sm group-hover:text-slate-300">المؤسسات التعليمية</p></div>
      </div>
      <div class="bg-surface-container-lowest p-8 rounded-md flex flex-col justify-between h-48 group hover:bg-primary transition-colors duration-300 cursor-pointer">
        <span class="material-symbols-outlined text-secondary text-4xl group-hover:text-secondary-fixed">task_alt</span>
        <div><p class="text-3xl font-headline font-bold text-primary group-hover:text-white">{{ $totalActivities }}</p><p class="text-on-surface-variant text-sm group-hover:text-slate-300">مجموع الأنشطة</p></div>
      </div>
    </div>
  </div>
</section>

<section class="py-24 px-6 max-w-7xl mx-auto">
  <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
    <div><span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">الهيئة التداولية</span><h2 class="font-headline text-primary text-3xl font-bold mt-2">المجلس الإداري للأكاديمية</h2></div>
    <a href="{{ route('council') }}" class="text-primary font-bold flex items-center gap-2 hover:underline"><span>عرض الكل</span><span class="material-symbols-outlined">arrow_back</span></a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($councils as $council)
    <div onclick="window.location='{{ route('council.show', $council->id) }}'" class="bg-surface-container-lowest rounded-md overflow-hidden group cursor-pointer border border-transparent hover:border-slate-200 transition-all">
      <div class="h-48 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
        @if($council->tof)
          <img src="{{ asset('storage/' . $council->tof) }}" class="w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-opacity">
        @else
          <span class="material-symbols-outlined text-emerald-400 text-6xl">gavel</span>
        @endif
      </div>
      <div class="p-6">
        <p class="text-secondary text-xs font-bold mb-2">دورة {{ $council->mois }} {{ $council->yr }}</p>
        <h3 class="font-headline font-bold text-lg mb-3 group-hover:text-secondary transition-colors">الدورة العادية للمجلس الإداري</h3>
        <p class="text-on-surface-variant text-sm line-clamp-2">{{ $council->lieu }} — {{ $council->dte }}</p>
      </div>
    </div>
    @endforeach
  </div>
</section>

<footer class="w-full py-12 px-6 border-t border-slate-100 bg-slate-50 mt-12">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
    <div class="col-span-1 md:col-span-2">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-9 h-9 bg-black rounded-lg flex items-center justify-center"><span class="text-emerald-400 font-headline font-black text-base">أ</span></div>
        <h3 class="text-lg font-bold text-slate-900 font-headline">الأكاديمية الجهوية للتربية والتكوين — سوس ماسة</h3>
      </div>
      <p class="text-slate-500 text-sm max-w-sm mb-6 leading-relaxed">المرجع الأول في التطوير التربوي الجهوي، الملتزم بالشفافية والتميز ومستقبل الأجيال القادمة.</p>
    </div>
    <div>
      <h4 class="font-headline font-bold text-primary mb-4">الموقع</h4>
      <ul class="space-y-2">
        <li><a href="{{ route('home') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">الرئيسية</a></li>
        <li><a href="{{ route('activities') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">الأنشطة</a></li>
        <li><a href="{{ route('council') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">المجلس الإداري</a></li>
        <li><a href="{{ route('initiatives') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">مبادرات جهوية</a></li>
      </ul>
    </div>
    <div>
      <h4 class="font-headline font-bold text-primary mb-4">الإدارة</h4>
      <ul class="space-y-2">
        <li><a href="{{ route('login') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">تسجيل الدخول</a></li>
        <li><a href="#" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">التقارير السنوية</a></li>
        <li><a href="{{ route('contact') }}" class="text-slate-500 hover:text-emerald-600 text-sm hover:underline underline-offset-4">تواصل معنا</a></li>
      </ul>
    </div>
  </div>
  <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-200">
    <p class="text-center text-slate-400 text-xs">© {{ date('Y') }} الأكاديمية الجهوية للتربية والتكوين — سوس ماسة. جميع الحقوق محفوظة. — تصميم المركز الجهوي لمنظومة الإعلام</p>
  </div>
</footer>
@endsection