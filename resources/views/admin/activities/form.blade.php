@extends('layouts.admin')
@section('title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')
@section('page-title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')

@section('content')
<div class="max-w-4xl" dir="rtl">

  <h2 class="font-headline text-xl font-black text-slate-900 mb-6 text-right">
    {{ isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد' }}
  </h2>

  <form method="POST"
        action="{{ isset($activity) ? route('admin.activities.update', $activity->id) : route('admin.activities.store') }}"
        enctype="multipart/form-data"
        class="bg-surface-container-lowest rounded-md p-6 space-y-6">

    @csrf
    @if(isset($activity)) @method('PUT') @endif

    {{-- ERRORS --}}
    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md text-sm font-bold text-right">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- بيانات النشاط --}}
    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 pb-3 border-b border-slate-100 text-right">
      بيانات النشاط
    </p>

    <div class="grid grid-cols-2 gap-4">

      {{-- نوع النشاط --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">نوع النشاط *</label>
        <select name="typ" class="form-ctrl w-full">
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('typ', $activity->typ ?? '') == $cat->id ? 'selected' : '' }}>
              {{ $cat->caty }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- التاريخ --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">تاريخه *</label>
        <input name="dte" type="date"
               value="{{ old('dte', $activity->dte ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

      {{-- الوقت --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">على الساعة</label>
        <input name="hr" type="time"
               value="{{ old('hr', $activity->hr ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

      {{-- المسؤول --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">المسؤول عن النشاط *</label>
        <input name="resp" type="text"
               value="{{ old('resp', $activity->resp ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

    </div>

    {{-- العنوان --}}
    <div class="text-right">
      <label class="block text-xs font-bold text-slate-500 mb-2">عنوان النشاط *</label>
      <textarea name="title" class="form-ctrl w-full">{{ old('title', $activity->title ?? '') }}</textarea>
    </div>

    {{-- التفاصيل --}}
    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2 pb-3 border-b border-slate-100 text-right">
      التفاصيل
    </p>

    <div class="grid grid-cols-2 gap-4">

      {{-- المكان --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">مكانه *</label>
        <input name="lieu" type="text"
               value="{{ old('lieu', $activity->lieu ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

      {{-- المستفيدون --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">المستفيدون</label>
        <input name="benfs" type="text"
               value="{{ old('benfs', $activity->benfs ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

      {{-- العدد --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">عددهم</label>
        <input name="nb" type="number"
               value="{{ old('nb', $activity->nb ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

      {{-- المرجع --}}
      <div class="text-right">
        <label class="block text-xs font-bold text-slate-500 mb-2">المرجع</label>
        <input name="ref" type="text"
               value="{{ old('ref', $activity->ref ?? '') }}"
               class="form-ctrl w-full"/>
      </div>

    </div>

    {{-- الصور --}}
    <div class="text-right">
      <label class="block text-xs font-bold text-slate-500 mb-2">صور النشاط</label>
      <input name="photos[]" type="file" multiple accept="image/*" class="form-ctrl w-full"/>
    </div>

    {{-- buttons --}}
    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
      <a href="{{ route('admin.activities.index') }}"
         class="border border-outline-variant text-primary px-6 py-2.5 rounded-md font-bold text-sm">
        إلغاء
      </a>

      <button type="submit"
              class="bg-secondary text-white px-6 py-2.5 rounded-md font-bold text-sm hover:shadow-md active:scale-95">
        {{ isset($activity) ? 'حفظ التعديلات' : 'إضافة النشاط' }}
      </button>
    </div>

  </form>
</div>
@endsection