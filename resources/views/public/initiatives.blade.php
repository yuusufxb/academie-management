@extends('layouts.app')
@section('title', 'المبادرات المتميزة')
@section('content')
<div class="pt-16">
  <section class="bg-surface-container-low py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="mb-12 text-right" dir="rtl">
        <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">المبادرات الجهوية المتميزة</span>
        <h2 class="font-headline text-primary text-3xl font-bold mt-2">المبادرات المتميزة</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8" dir="rtl">
        @forelse($initiatives as $item)
          <a href="{{ route('initiatives.show', $item->id) }}" class="block">
            <div class="bg-surface-container-lowest rounded-md overflow-hidden group cursor-pointer shadow-sm hover:shadow-md transition-shadow">
              
              {{-- عرض الصورة من قاعدة البيانات --}}
              <div class="h-48 relative overflow-hidden flex items-center justify-center bg-slate-200">
                @if($item->tof)
                  {{-- عرض الصورة المخزنة في حقل tof --}}
                  <img src="{{ photo_asset($item->tof) }}" 
                       alt="{{ $item->title }}"
                       class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                  {{-- في حال عدم وجود صورة، نعرض صورة افتراضية أو خلفية ملونة بدلاً من الأيقونة --}}
                  <div class="w-full h-full bg-gradient-to-br from-slate-700 to-emerald-900 flex items-center justify-center">
                    <span class="text-white/20 font-bold">لا توجد صورة</span>
                  </div>
                @endif
              </div>

              <div class="p-6 text-right">
                <div class="flex items-center justify-start gap-2 text-on-surface-variant text-xs mb-3">
                  <span class="{{ $item->typ == 'جهوي' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }} text-[10px] font-bold px-2 py-0.5 rounded-full">
                    {{ $item->typ ?? 'محلي' }}
                  </span>
                </div>
                
                <h3 class="font-headline font-bold text-xl mb-3 group-hover:text-secondary transition-colors leading-tight">
                  {{ $item->title }}
                </h3>
                
                <p class="text-on-surface-variant text-sm line-clamp-3">
                  {{ strip_tags($item->infos) }}
                </p>
              </div>
            </div>
          </a>
        @empty
          <p class="col-span-3 text-center py-20 text-on-surface-variant">لا توجد مبادرات متميزة حالياً.</p>
        @endforelse
      </div>

      <div class="mt-12 text-center">
        {{ $initiatives->links() }}
      </div>
    </div>
  </section>
</div>
@endsection