@extends('layouts.app')
@section('title', 'صوت وصورة')
@section('content')
<div class="pt-16">
  <section class="bg-primary-container text-white py-24">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16">
      <div class="lg:col-span-4">
        <span class="text-secondary-fixed text-xs font-label font-bold tracking-[0.2em] uppercase">صوت وصورة</span>
        <h2 class="font-headline text-4xl font-extrabold mt-4 mb-8">أرشيف الأخبار والمواد الإعلامية</h2>
        <p class="text-on-primary-container text-lg mb-10">تابع أبرز الأخبار والتغطيات الإعلامية لفعاليات الأكاديمية الجهوية عبر مختلف المنابر.</p>
        <div class="space-y-6">
          <div class="group cursor-pointer"><p class="text-secondary-fixed text-xs font-bold mb-1">تغطية إعلامية</p><h4 class="font-headline font-bold text-lg group-hover:text-secondary-fixed transition-colors">مواكبة قناة M24 لامتحانات الباكالوريا دورة يونيو 2023</h4></div>
          <div class="group cursor-pointer border-t border-white/10 pt-6"><p class="text-secondary-fixed text-xs font-bold mb-1">مقابلة</p><h4 class="font-headline font-bold text-lg group-hover:text-secondary-fixed transition-colors">الدخول المدرسي 2025/2024 بجهة سوس ماسة</h4></div>
          <div class="group cursor-pointer border-t border-white/10 pt-6"><p class="text-secondary-fixed text-xs font-bold mb-1">تقرير</p><h4 class="font-headline font-bold text-lg group-hover:text-secondary-fixed transition-colors">الملتقى الجهوي للتميز التربوي بأكاديمية سوس ماسة</h4></div>
        </div>
      </div>
      <div class="lg:col-span-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="relative group aspect-video rounded-xl overflow-hidden cursor-pointer bg-gradient-to-br from-slate-700 to-emerald-900 flex items-center justify-center">
            <span class="material-symbols-outlined text-6xl text-white/40">smart_display</span>
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"><span class="material-symbols-outlined text-6xl text-white">play_circle</span></div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="rounded-lg h-32 w-full bg-gradient-to-br from-emerald-800 to-slate-800 flex items-center justify-center"><span class="material-symbols-outlined text-white/40 text-4xl">image</span></div>
            <div class="rounded-lg h-32 w-full bg-gradient-to-br from-slate-800 to-slate-700 flex items-center justify-center"><span class="material-symbols-outlined text-white/40 text-4xl">image</span></div>
            <div class="rounded-lg h-32 w-full bg-gradient-to-br from-slate-700 to-emerald-900 flex items-center justify-center"><span class="material-symbols-outlined text-white/40 text-4xl">image</span></div>
            <div class="bg-white/10 rounded-lg h-32 flex items-center justify-center text-sm font-bold cursor-pointer hover:bg-white/20 transition-all">+24 المزيد</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
