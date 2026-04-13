@extends('layouts.app')
@section('title', 'المجلس الإداري')
@section('content')
<div class="pt-16" dir="rtl">
  <section class="py-24 px-6 max-w-7xl mx-auto">
    <div class="text-center mb-12">
      <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">الهيئة التداولية</span>
      <h2 class="font-headline text-primary text-3xl font-bold mt-2">المجلس الإداري للأكاديمية</h2>
      <p class="text-on-surface-variant max-w-xl mx-auto mt-3">تتبع أنشطة المجلس الإداري: الدورات، المقررات، والتقارير الرسمية للأكاديمية.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @forelse($councils as $session)
        <div class="bg-surface-container-lowest rounded-md overflow-hidden group cursor-pointer shadow-sm hover:shadow-md transition-all border border-slate-100">
          
          {{-- منطقة الصورة (tof) --}}
          <div class="h-56 relative overflow-hidden flex items-center justify-center bg-slate-900">
            @if($session->tof)
              {{-- الصورة الحقيقية من قاعدة البيانات --}}
              <img src="{{ asset('storage/' . $session->tof) }}" 
                   alt="دورة {{ $session->yr }}"
                   class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              {{-- طبقة تظليل خفيفة لتحسين المظهر --}}
              <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
            @else
              {{-- تدرج لوني في حال عدم وجود صورة --}}
              <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-emerald-900"></div>
              <span class="material-symbols-outlined text-emerald-400 text-6xl opacity-30">gavel</span>
            @endif

            {{-- أيقونة طافية تعطي طابع رسمي --}}
            <div class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                <span class="material-symbols-outlined text-white text-xl">gavel</span>
            </div>
          </div>

          <div class="p-6 text-right">
            {{-- التاريخ: شهر + سنة --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="bg-secondary/10 text-secondary text-[10px] font-bold px-2 py-1 rounded">
                    دورة {{ $session->mois }} {{ $session->yr }}
                </span>
                @if($session->dte)
                    <span class="text-slate-400 text-xs">{{ $session->dte }}</span>
                @endif
            </div>
            
            <h3 class="font-headline font-bold text-xl mb-3 group-hover:text-secondary transition-colors text-primary">
              المجلس الإداري - {{ $session->lieu ?? 'مقر الأكاديمية' }}
            </h3>
            
            {{-- مقتطف من التقرير (rap) --}}
            <p class="text-on-surface-variant text-sm line-clamp-2 leading-relaxed mb-6">
              {{ strip_tags($session->rap) }}
            </p>
            
            <a href="{{ route('council.show', $session->id) }}" class="block">
              <button class="w-full py-3 border border-slate-200 rounded-lg font-bold text-sm group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all flex items-center justify-center gap-2">
               عرض التفاصيل
                <span class="material-symbols-outlined text-sm">arrow_left</span>
              </button>
            </a>
          </div>
        </div>
      @empty
        <div class="col-span-2 text-center py-20 bg-slate-50 rounded-xl border border-dashed border-slate-300">
          <span class="material-symbols-outlined text-slate-300 text-5xl mb-4">inventory_2</span>
          <p class="text-slate-500 font-headline">لا توجد دورات مسجلة حالياً للمجلس الإداري.</p>
        </div>
      @endforelse
    </div>

    {{-- الترقيم --}}
    <div class="mt-12 flex justify-center">
      {{ $councils->links() }}
    </div>
  </section>
</div>
@endsection