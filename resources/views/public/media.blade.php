@extends('layouts.app')
@section('title', 'صوت وصورة')
@section('content')
<div class="pt-16">
  <section class="bg-primary-container text-white py-24">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16">
      
      {{-- القسم الأيمن: القائمة الجانبية (أحدث المواد) --}}
      <div class="lg:col-span-4" dir="rtl">
        <span class="text-secondary-fixed text-xs font-label font-bold tracking-[0.2em] uppercase">صوت وصورة</span>
        <h2 class="font-headline text-4xl font-extrabold mt-4 mb-8">أرشيف الأخبار والمواد الإعلامية</h2>
        <p class="text-on-primary-container text-lg mb-10">تابع أبرز الأخبار والتغطيات الإعلامية لفعاليات الأكاديمية الجهوية عبر مختلف المنابر.</p>
        
        <div class="space-y-6">
          @foreach($sidebarMedias as $item)
            <div class="group cursor-pointer {{ !$loop->first ? 'border-t border-white/10 pt-6' : '' }}">
              <p class="text-secondary-fixed text-xs font-bold mb-1">{{ $item->typ }}</p>
              <a href="{{ $item->link }}" target="_blank">
                <h4 class="font-headline font-bold text-lg group-hover:text-secondary-fixed transition-colors line-clamp-2">
                  {{ $item->title }}
                </h4>
              </a>
            </div>
          @endforeach
        </div>
      </div>

      {{-- القسم الأيسر: عرض المواد (فيديو وصور) --}}
      <div class="lg:col-span-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          {{-- العنصر الرئيسي (أحدث فيديو أو مادة) --}}
          @if($medias->count() > 0)
            @php $first = $medias->first(); @endphp
            <a href="{{ $first->link }}" target="_blank" class="relative group aspect-video rounded-xl overflow-hidden cursor-pointer bg-slate-800 flex items-center justify-center">
                @if($first->tof)
                    <img src="{{ asset('storage/' . $first->tof) }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-500">
                @endif
                
                @if($first->typ == 'فيديو' || str_contains($first->link, 'youtube'))
                    <span class="material-symbols-outlined text-6xl text-white/40 group-hover:opacity-0 transition-opacity">smart_display</span>
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-6xl text-white">play_circle</span>
                    </div>
                @else
                    <span class="material-symbols-outlined text-6xl text-white/40">image</span>
                @endif
            </a>
          @endif

          {{-- شبكة المواد الصغيرة --}}
          <div class="grid grid-cols-2 gap-4">
            @foreach($medias->slice(1, 3) as $item)
                <a href="{{ $item->link }}" target="_blank" class="relative rounded-lg h-32 w-full bg-slate-800 overflow-hidden flex items-center justify-center group">
                    @if($item->tof)
                        <img src="{{ asset('storage/' . $item->tof) }}" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-opacity">
                    @endif
                    <span class="material-symbols-outlined text-white/40 text-3xl z-10">
                        {{ ($item->typ == 'فيديو' || str_contains($item->link, 'youtube')) ? 'play_circle' : 'image' }}
                    </span>
                </a>
            @endforeach

            {{-- زر المزيد --}}
            <div class="bg-white/10 rounded-lg h-32 flex items-center justify-center text-sm font-bold cursor-pointer hover:bg-white/20 transition-all">
                +{{ $medias->total() > 4 ? $medias->total() - 4 : 0 }} المزيد
            </div>
          </div>
          
        </div>

        {{-- الترقيم (Pagination) إذا أردت إظهاره --}}
        <div class="mt-8 flex justify-end">
            {{ $medias->links() }}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection