@extends('layouts.admin')
@section('title', isset($press) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($press) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية' }}
  </h2>
  <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl">
  <form method="POST"
        action="{{ isset($press) ? route('admin.press.update', $press['id'] ?? 1) : route('admin.press.store') }}"
        enctype="multipart/form-data">
    @csrf @if(isset($press)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الصحيفة</label>
        <input name="media_outlet" type="text" value="{{ $press['media_outlet'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تاريخها</label>
        <input name="publish_date" type="date" value="{{ $press['publish_date'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">عنوان المقال</label>
        <input name="title" type="text" value="{{ $press['title'] ?? '' }}" class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رابط المقال</label>
        <input name="url" type="url" value="{{ $press['url'] ?? '' }}" placeholder="https://..." class="form-ctrl"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تحميل الصور</label>
        <input name="image" type="file" accept="image/*" class="form-ctrl" style="padding:6px"/>
      </div>

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المقال</label>
        <textarea name="content" class="form-ctrl" style="height:120px">{{ $press['content'] ?? '' }}</textarea>
      </div>

      <div class="flex justify-end pt-2 border-t border-slate-100">
        <button type="submit"
                class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
          حفظ المعلومات
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
