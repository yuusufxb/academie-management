@extends('layouts.admin')
@section('title', isset($council) ? 'تعديل المجلس الإداري' : 'إضافة مجلس جديد')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{-- تصحيح المتغير ليعرض العنوان بشكل ديناميكي --}}
    {{ isset($council) ? 'تعديل المجلس الإداري دورة '.$council->mois.' '.$council->yr : 'إضافة مجلس جديد' }}
  </h2>
  <a href="{{ route('admin.council') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>
  
<div class="max-w-2xl">
  <form method="POST"
        action="{{ isset($council) ? route('admin.council.update', $council->id) : route('admin.council.store') }}"
        enctype="multipart/form-data">
    @csrf 
    @if(isset($council)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

      {{-- دورة --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">دورة</label>
        <input name="mois" type="text" value="{{ old('mois', $council->mois ?? '') }}" placeholder="يناير" class="form-ctrl"/>
      </div>

      {{-- السنة --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">السنة</label>
        <input name="yr" type="number" value="{{ old('yr', $council->yr ?? '') }}" class="form-ctrl"/>
      </div>

      {{-- تاريخه --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تاريخه</label>
        <input name="dte" type="date" value="{{ old('dte', $council->dte ?? '') }}" class="form-ctrl"/>
      </div>

      {{-- مكانه --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">مكانه</label>
        <input name="lieu" type="text" value="{{ old('lieu', $council->lieu ?? '') }}" class="form-ctrl"/>
      </div>

      {{-- تقرير --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تقرير</label>
        <textarea name="rap" class="form-ctrl" style="height:100px">{{ old('rap', $council->rap ?? '') }}</textarea>
      </div>

      {{-- صورة --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">صورة</label>
        @if(isset($council) && !empty($council->tof))
          <img src="{{ photo_asset($council->tof) }}" class="h-28 rounded-md mb-2 object-cover"/>
        @endif
        <input name="tof" type="file" accept="image/*" class="form-ctrl" style="padding:6px"/>
      </div>

      <div class="flex justify-end pt-2 border-t border-slate-100">
        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
          حفظ المعلومات
        </button>
      </div>
    </div>
  </form>
</div>
@endsection