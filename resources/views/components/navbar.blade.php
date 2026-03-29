<nav class="fixed top-0 w-full z-50 glass-header shadow-sm">
  <div class="flex items-center max-w-7xl mx-auto px-6 h-16 gap-0">
    <!-- LOGO -->
    <div class="flex items-center gap-3 ml-0 mr-0 flex-shrink-0">
      <div class="w-9 h-9 bg-black rounded-lg flex items-center justify-center flex-shrink-0">
        <span class="text-emerald-400 font-headline font-black text-base">أ</span>
      </div>
      <div>
        <span class="text-sm font-headline font-black text-slate-900 tracking-tight block leading-tight">الأكاديمية الجهوية</span>
        <span class="text-[10px] text-slate-400 font-label leading-tight block">Souss-Massa</span>
      </div>
    </div>
    <!-- NAV LINKS CENTER -->
    <div class="hidden md:flex items-center gap-1 mx-auto">
      <a href="{{ route('home') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('home') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        الرئيسية
      </a>
      <a href="{{ route('activities') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('activities*') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        الأنشطة
      </a>
      <a href="{{ route('media') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('media') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        صوت وصورة
      </a>
      <a href="{{ route('initiatives') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('initiatives') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        مبادرات جهوية
      </a>
      <a href="{{ route('council') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('council') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        المجلس الإداري
      </a>
      <a href="{{ route('contact') }}"
         class="font-headline text-sm font-semibold tracking-tight px-3 py-2 transition-all cursor-pointer rounded-md
                {{ request()->routeIs('contact') ? 'text-emerald-600 border-b-2 border-emerald-500 pb-0.5' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60' }}">
        تواصل
      </a>
    </div>
    <!-- ADMIN BTN -->
    <a href="{{ route('login') }}" class="bg-primary text-white px-5 py-2 rounded-md font-headline text-sm font-semibold tracking-tight active:scale-95 duration-200 flex-shrink-0">
      الإدارة ↙
    </a>
  </div>
</nav>
