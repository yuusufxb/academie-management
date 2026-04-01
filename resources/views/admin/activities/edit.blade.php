@extends('layouts.admin')
@section('title', isset($activity) ? 'تعديل النشاط' : 'إضافة نشاط جديد')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($activity) ? 'إضافة نشاط جديد' : 'إضافة نشاط جديد' }}
  </h2>
  <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl">
  <form method="POST" action="{{ isset($activity) ? route('admin.activities.update', $activity['id'] ?? 1) : route('admin.activities.store') }}" enctype="multipart/form-data">
    @csrf @if(isset($activity)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">نوع النشاط</label>
        <select name="type" class="form-ctrl">
          @foreach(['دورة تكوينية','احتفال','مسابقة','رياضة','لقاء','ورشة','نشاط آخر'] as $t)
          <option value="{{ $t }}" {{ ($activity['type'] ?? '') === $t ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تاريخه</label>
        <input name="date" type="date" value="{{ $activity['date'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">على الساعة</label>
        <input name="time" type="time" value="{{ $activity['time'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">عنوان النشاط</label>
        <textarea name="title" class="form-ctrl" style="height:80px">{{ $activity['title'] ?? '' }}</textarea>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المسؤول عن النشاط</label>
        <input name="responsible" type="text" value="{{ $activity['responsible'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">مكانه</label>
        <input name="place" type="text" value="{{ $activity['place'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المستفيدون</label>
        <input name="beneficiaries" type="text" value="{{ $activity['beneficiaries'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">عددهم</label>
        <input name="beneficiaries_count" type="number" value="{{ $activity['beneficiaries_count'] ?? 0 }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المرجع</label>
        <input name="reference" type="text" value="{{ $activity['reference'] ?? '' }}" placeholder="..." class="form-ctrl"/>
      </div>

      <div class="flex justify-end pt-2 border-t border-slate-100">
        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
          حفظ التغييرات
        </button>
      </div>
    </div>
  </form>
  
</div>
@endsection
