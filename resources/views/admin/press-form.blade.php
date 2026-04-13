@extends('layouts.admin')
@section('title', isset($clipping) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5" dir="rtl">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($clipping) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية' }}
  </h2>
  <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl" dir="rtl">
  <form method="POST"
        action="{{ isset($clipping) ? route('admin.press.update', $clipping->id) : route('admin.press.store') }}"
        enctype="multipart/form-data">
    @csrf 
    @if(isset($clipping)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5 text-right">
      
      {{-- حقل المنبر الإعلامي (Journal) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">الصحيفة *</label>
        <input name="journal" type="text" value="{{ old('journal', $clipping->journal ?? '') }}" class="form-ctrl w-full" required/>
        @error('journal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- حقل التاريخ (Dte) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">تاريخها *</label>
        <input name="dte" type="date" value="{{ old('dte', $clipping->dte ?? '') }}" class="form-ctrl w-full" required/>
        @error('dte') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- حقل العنوان (Titre) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">عنوان المقال *</label>
        <input name="titre" type="text" value="{{ old('titre', $clipping->titre ?? '') }}" class="form-ctrl w-full" required/>
        @error('titre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- حقل الرابط (Lien) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">رابط المقال</label>
        <input name="lien" type="url" value="{{ old('lien', $clipping->lien ?? '') }}" placeholder="https://..." class="form-ctrl w-full" style="direction: ltr; text-align: left;"/>
      </div>

      {{-- حقل الصورة (Photo) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">تحميل الصور</label>
        <input name="photo" type="file" accept="image/*" class="form-ctrl w-full" style="padding:6px"/>
        @if(isset($clipping->photo))
           <p class="text-[10px] text-slate-400 mt-1 italic">توجد صورة مرفوعة مسبقاً</p>
        @endif
      </div>

      {{-- حقل المحتوى (Txt) --}}
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2">المقال</label>
        <textarea name="txt" class="form-ctrl w-full" style="height:120px">{{ old('txt', $clipping->txt ?? '') }}</textarea>
      </div>

      <div class="flex justify-end pt-4 border-t border-slate-100">
        <button type="submit"
                class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
          {{ isset($clipping) ? 'تحديث المعلومات' : 'حفظ المعلومات' }}
        </button>
      </div>
    </div>
  </form>
</div>
@endsection 