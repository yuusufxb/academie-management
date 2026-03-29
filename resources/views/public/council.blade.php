@extends('layouts.app')
@section('title', 'المجلس الإداري')
@section('content')
<div class="pt-16">
  <section class="py-24 px-6 max-w-7xl mx-auto">
    <div class="text-center mb-12">
      <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">الهيئة التداولية</span>
      <h2 class="font-headline text-primary text-3xl font-bold mt-2">المجلس الإداري للأكاديمية</h2>
      <p class="text-on-surface-variant max-w-xl mx-auto mt-3">تتبع أنشطة المجلس الإداري: الدورات، المقررات، والتقارير الرسمية للأكاديمية.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @php
        $sessions = [
          ['icon'=>'gavel','grad'=>'from-slate-800 to-emerald-900','date'=>'دورة دجنبر 2018','title'=>'الدورة الأولى للمجلس الإداري','desc'=>'انعقدت الدورة الأولى للمجلس الإداري للأكاديمية الجهوية بمقر ولاية جهة سوس ماسة في 11 دجنبر 2017.'],
          ['icon'=>'how_to_vote','grad'=>'from-slate-700 to-slate-900','date'=>'دورة دجنبر 2021','title'=>'الدورة العادية للمجلس الإداري','desc'=>'صادق المجلس الإداري للأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة بمقر ولاية جهة سوس ماسة.'],
          ['icon'=>'workspace_premium','grad'=>'from-emerald-900 to-slate-900','date'=>'دورة دجنبر 2022','title'=>'الدورة العادية الثانية للمجلس الإداري','desc'=>'ترأس السيد يوسف بلقاسمي، الكاتب العام لوزارة التربية الوطنية بتفويض من السيد وزير...'],
          ['icon'=>'domain_verification','grad'=>'from-slate-800 to-emerald-800','date'=>'دورة دجنبر 2023','title'=>'انعقاد الدورة العادية للمجلس الإداري 2023','desc'=>'انعقدت الدورة العادية للمجلس الإداري للأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة برسم سنة 2023.'],
        ];
      @endphp
      @foreach($sessions as $session)
        <div class="bg-surface-container-lowest rounded-md overflow-hidden group cursor-pointer">
          <div class="h-40 bg-gradient-to-br {{ $session['grad'] }} flex items-center justify-center">
            <span class="material-symbols-outlined text-emerald-400 text-5xl">{{ $session['icon'] }}</span>
          </div>
          <div class="p-6">
            <p class="text-secondary text-xs font-bold mb-2">{{ $session['date'] }}</p>
            <h3 class="font-headline font-bold text-lg mb-2 group-hover:text-secondary transition-colors">{{ $session['title'] }}</h3>
            <p class="text-on-surface-variant text-sm line-clamp-2">{{ $session['desc'] }}</p>
            <button class="w-full mt-4 py-3 border border-outline-variant rounded-md font-bold text-sm group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all">عرض التفاصيل</button>
          </div>
        </div>
      @endforeach
    </div>
  </section>
</div>
@endsection
