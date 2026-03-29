@extends('layouts.admin')
@section('title', 'مكتبة الصور')
@section('page-title', 'مكتبة الصور')
@section('content')
@php
    $photosList = $photos ?? collect(range(1,4));
@endphp
<h2 class="font-headline text-xl font-black text-slate-900 mb-4">ألبوم الصور</h2>
<div class="bg-surface-container-lowest rounded-md p-5">
  <p class="text-sm font-bold text-slate-700 mb-4">صور الانشطة التي تم انجازها</p>
  <div class="photo-grid">
    @forelse($photosList as $photo)
      <div class="bg-white border border-slate-100 rounded-md overflow-hidden hover:shadow-md transition-all cursor-pointer">
        <div class="photo-thumb">
          @if(is_object($photo) && $photo->path)
            <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-full object-cover"/>
          @else
            <span class="material-symbols-outlined text-slate-300">image</span>
          @endif
        </div>
        <div class="p-3">
          <p class="text-xs font-bold text-slate-800">صورة رقم : {{ is_object($photo) ? $photo->id : $photo }}</p>
          <p class="text-[11px] text-slate-400">{{ is_object($photo) ? $photo->created_at->format('Y-m-d') : '2022-03-13' }}</p>
          <div class="flex gap-1 mt-2">
            <button class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></button>
            <button class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></button>
          </div>
        </div>
      </div>
      @empty
  <p class="text-slate-400 text-sm">لا توجد صور</p>
    @endforelse
  </div>
</div>
@endsection
