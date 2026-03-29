@extends('layouts.admin')
@section('title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')
@section('page-title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')

@section('content')
<div class="max-w-4xl">

  <h2 class="font-headline text-xl font-black text-slate-900 mb-6">
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
      <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md text-sm">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- بيانات النشاط --}}
    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 pb-3 border-b border-slate-100">
      بيانات النشاط
    </p>

    <div class="grid grid-cols-2 gap-4">

      {{-- نوع النشاط --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">نوع النشاط *</label>
        <select name="type" class="form-ctrl">
          @foreach(['احتفال','ورشة','مسابقة','رياضة','لقاء','دورة تكوينية','نشاط آخر'] as $t)
            <option {{ old('type', $activity->type ?? '') == $t ? 'selected' : '' }}>
              {{ $t }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- التاريخ --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">تاريخه *</label>
        <input name="date" type="date"
               value="{{ old('date', $activity->date ?? '') }}"
               class="form-ctrl"/>
      </div>

      {{-- الوقت --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">على الساعة</label>
        <input name="time" type="time"
               value="{{ old('time', $activity->time ?? '') }}"
               class="form-ctrl"/>
      </div>

      {{-- المسؤول --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">المسؤول عن النشاط *</label>
        <input name="responsible" type="text"
               value="{{ old('responsible', $activity->responsible ?? '') }}"
               class="form-ctrl"/>
      </div>

    </div>

    {{-- العنوان --}}
    <div>
      <label class="block text-xs font-bold text-slate-500 mb-2">عنوان النشاط *</label>
      <textarea name="title" class="form-ctrl">{{ old('title', $activity->title ?? '') }}</textarea>
    </div>

    {{-- التفاصيل --}}
    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2 pb-3 border-b border-slate-100">
      التفاصيل
    </p>

    <div class="grid grid-cols-2 gap-4">

      {{-- المكان --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">مكانه *</label>
        <input name="place" type="text"
               value="{{ old('place', $activity->place ?? '') }}"
               class="form-ctrl"/>
      </div>

      {{-- المستفيدون --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">المستفيدون</label>
        <input name="beneficiaries" type="text"
               value="{{ old('beneficiaries', $activity->beneficiaries ?? '') }}"
               class="form-ctrl"/>
      </div>

      {{-- العدد --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">عددهم</label>
        <input name="count" type="number"
               value="{{ old('count', $activity->count ?? '') }}"
               class="form-ctrl"/>
      </div>

      {{-- المرجع --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 mb-2">المرجع</label>
        <input name="reference" type="text"
               value="{{ old('reference', $activity->reference ?? '') }}"
               class="form-ctrl"/>
      </div>

    </div>

    {{-- الصور --}}
    <div>
      <label class="block text-xs font-bold text-slate-500 mb-2">صور النشاط</label>
      <input name="photos[]" type="file" multiple accept="image/*" class="form-ctrl"/>
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