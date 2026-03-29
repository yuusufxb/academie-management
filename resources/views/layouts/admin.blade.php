<!DOCTYPE html>
<html class="light" lang="ar" dir="rtl">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title', 'لوحة الإدارة') — الأكاديمية الجهوية</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Public+Sans:wght@300;400;500;600&family=Inter:wght@400;500;600&family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode:"class",
  theme:{
    extend:{
      colors:{
        "primary-container":"#101b30","secondary-fixed-dim":"#59de9b","tertiary-container":"#001d36",
        "surface-container-high":"#e7e8e9","primary":"#000000","error-container":"#ffdad6",
        "on-tertiary-fixed-variant":"#2f4865","surface-container":"#edeeef","surface-container-low":"#f3f4f5",
        "on-tertiary-fixed":"#001d36","outline":"#74777d","on-background":"#191c1d",
        "on-tertiary-container":"#6d86a5","secondary-container":"#75f8b3","on-error":"#ffffff",
        "secondary-fixed":"#78fbb6","on-secondary-fixed":"#002111","tertiary":"#000000",
        "primary-fixed":"#d7e2ff","error":"#ba1a1a","on-primary-container":"#79849d",
        "secondary":"#006d43","on-surface":"#191c1d","inverse-surface":"#2e3132",
        "tertiary-fixed":"#d1e4ff","inverse-primary":"#bbc6e2","surface-container-lowest":"#ffffff",
        "tertiary-fixed-dim":"#afc9ea","background":"#f8f9fa","surface-container-highest":"#e1e3e4",
        "on-primary-fixed-variant":"#3c475d","on-secondary-container":"#007147",
        "inverse-on-surface":"#f0f1f2","on-tertiary":"#ffffff","on-error-container":"#93000a",
        "surface-variant":"#e1e3e4","surface-bright":"#f8f9fa","on-secondary-fixed-variant":"#005232",
        "on-secondary":"#ffffff","on-surface-variant":"#44474c","primary-fixed-dim":"#bbc6e2",
        "outline-variant":"#c4c6cc","surface-dim":"#d9dadb","surface":"#f8f9fa",
        "on-primary":"#ffffff","surface-tint":"#545e76","on-primary-fixed":"#101b30"
      },
      fontFamily:{
        "headline":["Tajawal","Manrope"],"body":["Tajawal","Public Sans"],"label":["Tajawal","Inter"]
      },
      borderRadius:{"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},
    },
  },
}
</script>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@stack('styles')
</head>
<body class="bg-surface font-body text-on-surface overflow-x-hidden">

<!-- ADMIN TOPBAR -->
<div class="fixed top-0 left-0 right-0 z-50 h-14 bg-white border-b border-slate-100 shadow-sm flex items-stretch">
  <div class="flex items-center gap-3 bg-slate-900 px-5 min-w-[230px] flex-shrink-0">
    <div class="w-7 h-7 bg-emerald-500 rounded-md flex items-center justify-center">
      <span class="font-headline font-black text-sm text-white">أ</span>
    </div>
    <div>
      <strong class="block text-xs font-headline font-black text-white leading-tight">الأكاديمية الجهوية</strong>
      <span class="text-[10px] text-white/35">سوس ماسة</span>
    </div>
  </div>
  <div class="flex-1 flex items-center justify-center px-6 gap-2">
    <span class="text-slate-400 text-sm font-label">مصلحة التواصل وتتبع أشغال المجلس الإداري</span>
    <span class="text-slate-300">:</span>
    <span class="text-slate-800 text-sm font-bold font-label">@yield('page-title', 'لوحة التتبع')</span>
  </div>
  <div class="flex items-center gap-2 px-4">
    <a href="{{ route('admin.messages') }}" class="w-8 h-8 rounded-md bg-slate-100 hover:bg-slate-200 flex items-center justify-center relative transition-all">
      <span class="material-symbols-outlined text-slate-500 text-lg">notifications</span>
      <span class="absolute -top-1 -left-1 w-4 h-4 bg-red-500 rounded-full text-[9px] text-white flex items-center justify-center font-bold">3</span>
    </a>
    <button class="w-8 h-8 rounded-md bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-all">
      <span class="material-symbols-outlined text-slate-500 text-lg">help</span>
    </button>
    <div class="flex items-center gap-2 px-3 py-1.5 rounded-md hover:bg-slate-50 cursor-pointer transition-all relative group">
      <span class="text-sm font-bold text-slate-700 font-label">مرحباً بك، {{ auth()->user()->name ?? 'Stagaire' }}</span>
      <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-sm font-black text-white">
        {{ mb_substr(auth()->user()->name ?? 'S', 0, 1) }}
      </div>
      <span class="material-symbols-outlined text-slate-400 text-sm">expand_more</span>
      <div class="absolute top-full left-0 mt-1 w-44 bg-white border border-slate-100 rounded-lg shadow-xl z-50 overflow-hidden hidden group-hover:block">
        <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-label text-slate-700 hover:bg-slate-50 border-b border-slate-100">
          <span class="material-symbols-outlined text-slate-400 text-base">language</span>زيارة الموقع
        </a>
        <a href="{{ route('admin.messages') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-label text-slate-700 hover:bg-slate-50 border-b border-slate-100">
          <span class="material-symbols-outlined text-slate-400 text-base">mail</span>صندوق الرسائل
        </a>
        <a href="{{ route('admin.account') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-label text-slate-700 hover:bg-slate-50 border-b border-slate-100">
          <span class="material-symbols-outlined text-slate-400 text-base">person</span>الحساب
        </a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-label text-red-600 font-bold hover:bg-red-50">
            <span class="material-symbols-outlined text-red-400 text-base">logout</span>تسجيل الخروج
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="flex pt-14" style="min-height:100vh">
  @include('components.admin-sidebar')

  <main class="flex-1 mr-[230px] bg-surface-container-low min-h-screen">
    <div class="max-w-6xl mx-auto p-6">
      @yield('content')
    </div>
  </main>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
