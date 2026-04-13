@extends('layouts.admin')
@section('title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')
@section('page-title','تتبع الأنشطة')

@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد' }}
  </h2>
  <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl font-headline" dir="rtl">
  <form method="POST" action="{{ isset($activity) ? route('admin.activities.update', $activity->id) : route('admin.activities.store') }}" enctype="multipart/form-data">
    @csrf 
    @if(isset($activity)) @method('PUT') @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-5">

      {{-- نوع النشاط (مربوط بجدول الفئات) --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">نوع النشاط</label>
        <select name="typ" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none">
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (old('typ', $activity->typ ?? '') == $cat->id) ? 'selected' : '' }}>
              {{ $cat->caty }}
            </option>
          @endforeach
        </select>
        @error('typ') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- تاريخ النشاط --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">تاريخ النشاط</label>
          <input name="dte" type="date" value="{{ old('dte', $activity->dte ?? '') }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('dte') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- وقت النشاط --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">على الساعة</label>
          <input name="hr" type="time" value="{{ old('hr', $activity->hr ?? '') }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('hr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      {{-- عنوان النشاط --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">عنوان النشاط</label>
        <textarea name="title" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none" style="height:80px">{{ old('title', $activity->title ?? '') }}</textarea>
        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- المسؤول --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المسؤول عن النشاط</label>
          <input name="resp" type="text" value="{{ old('resp', $activity->resp ?? '') }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('resp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- المكان --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">مكان النشاط</label>
          <input name="lieu" type="text" value="{{ old('lieu', $activity->lieu ?? '') }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('lieu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- المستفيدون --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المستفيدون</label>
          <input name="benfs" type="text" value="{{ old('benfs', $activity->benfs ?? '') }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('benfs') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- عددهم --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">عددهم</label>
          <input name="nb" type="number" value="{{ old('nb', $activity->nb ?? 0) }}" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('nb') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      {{-- المرجع --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المرجع</label>
        <input name="ref" type="text" value="{{ old('ref', $activity->ref ?? '') }}" placeholder="..." class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
        @error('ref') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      {{-- زر الحفظ --}}
      <div class="flex justify-end pt-4 border-t border-slate-100">
        <button type="submit" class="px-6 py-2.5 bg-[#10b981] text-white rounded-lg font-bold text-sm hover:opacity-90 active:scale-95 transition-all">
          حفظ التغييرات
        </button>
      </div>
    </div>
  </form>
</div>
@endsection