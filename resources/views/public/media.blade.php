@extends('layouts.app')
@section('title', 'صوت وصورة')
@section('content')
<div class="pt-16">
  <section class="bg-primary-container text-white py-24">
    <div class="max-w-7xl mx-auto px-6">

      {{-- ===== Header ===== --}}
      <div class="mb-16" dir="rtl">
        <span class="text-secondary-fixed text-xs font-label font-bold tracking-[0.2em] uppercase">
          صوت وصورة
        </span>
        <h2 class="font-headline text-4xl font-extrabold mt-4 mb-4">
          أرشيف الأخبار والمواد الإعلامية
        </h2>
        <p class="text-white/60 text-lg max-w-2xl">
          تابع أبرز التغطيات الإعلامية لفعاليات الأكاديمية الجهوية عبر يوتيوب وفيسبوك.
        </p>
      </div>

      {{-- ===== YouTube Section ===== --}}
      @if($videos->count())
      <div class="mb-16" dir="rtl">

        {{-- Title --}}
        <div class="flex items-center gap-3 mb-8">
          <svg class="w-7 h-7 fill-current text-red-500" viewBox="0 0 24 24">
            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/>
          </svg>
          <h3 class="font-headline text-2xl font-bold text-secondary-fixed">فيديوهات يوتيوب</h3>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($videos as $v)
            @php
              // Extract YouTube ID from link
              $ytId = null;
              if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $v->link, $m)) {
                  $ytId = $m[1];
              }
              // Fallback: if tof looks like a raw YouTube ID (11 chars, no slashes/dots)
              if (!$ytId && $v->tof && strlen(trim($v->tof)) === 11 && !str_contains($v->tof, '/') && !str_contains($v->tof, '.')) {
                  $ytId = trim($v->tof);
              }
              // Build thumbnail URL
              $thumb = $ytId
                  ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg"
                  : ($v->tof && str_contains($v->tof, '/') ? photo_asset($v->tof) : null);
            @endphp

            <a href="{{ $v->link }}" target="_blank" rel="noopener"
               class="group relative aspect-video rounded-2xl overflow-hidden block bg-slate-900 shadow-lg hover:shadow-red-900/30 hover:shadow-2xl transition-all duration-300">

              {{-- Thumbnail --}}
              @if($thumb)
                <img src="{{ $thumb }}" alt="{{ $v->title }}"
                     class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-50 group-hover:scale-105 transition-all duration-500">
              @else
                <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-red-950"></div>
              @endif

              {{-- Gradient overlay --}}
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

              {{-- Play button --}}
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 rounded-full bg-red-600/90 flex items-center justify-center group-hover:scale-110 group-hover:bg-red-500 transition-all duration-300 shadow-xl">
                  <span class="material-symbols-outlined text-white text-3xl" style="padding-left:4px">play_arrow</span>
                </div>
              </div>

              {{-- Title & date --}}
              <div class="absolute bottom-0 left-0 right-0 p-4">
                <p class="text-white text-sm font-bold leading-snug line-clamp-2">
                  {{ $v->title }}
                </p>
                <p class="text-white/50 text-xs mt-1">{{ $v->created_at->format('d/m/Y') }}</p>
              </div>
            </a>
          @endforeach
        </div>

        {{-- YouTube Pagination --}}
        @if($videos->hasPages())
          <div class="mt-8 flex justify-center" dir="ltr">
            {{ $videos->appends(request()->except('yt_page'))->links() }}
          </div>
        @endif

      </div>
      @endif

      {{-- ===== Divider ===== --}}
      @if($videos->count() && $facebook->count())
        <div class="border-t border-white/10 mb-16"></div>
      @endif

      {{-- ===== Facebook Section ===== --}}
      @if($facebook->count())
      <div dir="rtl">

        {{-- Title --}}
        <div class="flex items-center gap-3 mb-8">
          <svg class="w-7 h-7 fill-current text-blue-400" viewBox="0 0 24 24">
            <path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.95.93-1.95 1.87v2.28h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07z"/>
          </svg>
          <h3 class="font-headline text-2xl font-bold text-secondary-fixed">فيديوهات فيسبوك</h3>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          @foreach($facebook as $v)
            <a href="{{ $v->link }}" target="_blank" rel="noopener"
               class="group flex items-start gap-5 bg-white/8 border border-white/10 rounded-2xl p-5 hover:bg-white/15 hover:border-blue-400/30 transition-all duration-300">

              {{-- Thumbnail or fallback --}}
              <div class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden bg-blue-700/40 flex items-center justify-center">
                @if($v->tof && str_contains($v->tof, '/'))
                  {{-- It's a storage file path (missing file → academy logo via photo_asset) --}}
                  <img src="{{ photo_asset($v->tof) }}" alt="{{ $v->title }}"
                       class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                  <img src="{{ photo_asset($v->tof) }}" alt="{{ $v->title }}" class="w-full h-full object-cover opacity-90">
                @endif
              </div>

              {{-- Text --}}
              <div class="flex-1 min-w-0">
                <span class="inline-flex items-center gap-1 text-blue-400 text-xs font-bold mb-2">
                  <span class="material-symbols-outlined text-sm">play_circle</span>
                  Facebook
                </span>
                <h4 class="font-headline font-bold text-white text-base leading-snug line-clamp-2 group-hover:text-secondary-fixed transition-colors">
                  {{ $v->title }}
                </h4>
                <p class="text-white/40 text-xs mt-2">{{ $v->created_at->format('d/m/Y') }}</p>
              </div>

              {{-- Arrow --}}
              <span class="material-symbols-outlined text-white/20 group-hover:text-secondary-fixed group-hover:-translate-x-1 transition-all flex-shrink-0 mt-1">
                arrow_back
              </span>
            </a>
          @endforeach
        </div>

        {{-- Facebook Pagination --}}
        @if($facebook->hasPages())
          <div class="mt-8 flex justify-center" dir="ltr">
            {{ $facebook->appends(request()->except('fb_page'))->links() }}
          </div>
        @endif

      </div>
      @endif

      {{-- ===== Empty State ===== --}}
      @if(!$videos->count() && !$facebook->count())
        <div class="text-center py-24 text-white/40" dir="rtl">
          <span class="material-symbols-outlined text-6xl mb-4 block">videocam_off</span>
          <p class="text-lg font-bold">لا توجد مواد إعلامية متاحة حالياً.</p>
        </div>
      @endif

    </div>
  </section>
</div>
@endsection