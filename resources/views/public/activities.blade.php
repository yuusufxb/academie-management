@extends('layouts.app')

@section('title', 'الأنشطة المدرسية')

@section('content')
<div class="pt-16">
  <section class="bg-surface-container-low py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row justify-between items-start mb-12 gap-6">
        <div>
          <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">الأنشطة المدرسية</span>
          <h2 class="font-headline text-primary text-3xl font-bold mt-2">آخر الأنشطة المنجزة</h2>
        </div>
      </div>

      <form method="GET" action="{{ route('activities') }}" class="bg-surface-container-lowest rounded-md p-6 mb-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">نوع النشاط</label>
            <select name="type" class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition-all font-body text-right">
              <option value="">اختر نوع النشاط</option>
              {{-- Logic Change: Pulling from Category Model --}}
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('type') == $category->id ? 'selected' : '' }}>{{ $category->caty }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">المسؤول عن النشاط</label>
            <input name="resp" type="text" value="{{ request('resp') }}" placeholder="المسؤول..." class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body"/>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">عنوان النشاط</label>
            <input name="title" type="text" value="{{ request('title') }}" placeholder="ابحث عن نشاط..." class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body"/>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">من:</label>
            <input name="from" type="date" value="{{ request('from') }}" class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 transition-all font-body"/>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">إلى:</label>
            <input name="to" type="date" value="{{ request('to') }}" class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 transition-all font-body"/>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">مكانه:</label>
            <input name="place" type="text" value="{{ request('place') }}" placeholder="المكان..." class="w-full bg-white border border-outline-variant rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body"/>
          </div>
          <div class="flex gap-3">
            <a href="{{ route('activities') }}" class="border border-outline-variant text-primary px-5 py-2.5 rounded-md font-headline font-bold text-sm hover:bg-surface-container-low transition-all">إعادة ضبط</a>
            <button type="submit" class="bg-primary text-white px-5 py-2.5 rounded-md font-headline font-bold text-sm hover:shadow-md active:scale-95 transition-all">البحث</button>
          </div>
        </div>
      </form>

      <p class="text-on-surface-variant text-sm mb-6 font-label">{{ $activities->total() }} نشاط</p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($activities as $activity)
          <div class="bg-surface-container-lowest rounded-md overflow-hidden group">
            <div class="relative h-56 overflow-hidden bg-gradient-to-br {{ $activity->color_class ?? 'from-slate-800 to-emerald-900' }} flex items-center justify-center">
              
              {{-- Logic Change: Check for Main Photo then First Photo --}}
              @php $displayPhoto = $activity->mainPhoto ?? $activity->photos->first(); @endphp
              
              @if($displayPhoto)
                <img src="{{ photo_asset($displayPhoto->path) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
              @else
                <span class="text-6xl opacity-30">{{ $activity->icon ?? '🎓' }}</span>
              @endif

              <div class="absolute top-4 right-4 {{ $activity->type_color ?? 'bg-teal-600' }} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                {{ $activity->type }}
              </div>  
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-on-surface-variant text-xs mb-3">
                <span class="material-symbols-outlined text-sm">calendar_today</span>{{ $activity->dte }}
                <span class="mx-1">•</span>
                <span class="material-symbols-outlined text-sm">location_on</span>{{ $activity->lieu }}
              </div>
              <h3 class="font-headline font-bold text-lg mb-3 group-hover:text-secondary transition-colors leading-snug">{{ $activity->title }}</h3>
              <p class="text-on-surface-variant text-sm line-clamp-2 mb-5">نشاط تربوي منظم في إطار برامج الأنشطة شبه المدرسية. المسؤول: {{ $activity->resp }}</p>
              <a href="{{ route('activities.show', $activity->id) }}" class="block w-full py-2.5 border border-outline-variant rounded-md font-bold text-sm text-center group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all">عرض التفاصيل</a>
            </div>
          </div>
        @empty
          <p class="col-span-3 text-center text-on-surface-variant py-20 text-lg">لا توجد أنشطة مطابقة للبحث.</p>
        @endforelse
      </div>

      <div class="mt-10">{{ $activities->withQueryString()->links() }}</div>
    </div>
  </section>
</div>
@endsection