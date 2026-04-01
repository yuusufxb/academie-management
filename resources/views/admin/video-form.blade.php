@extends('layouts.admin')
@section('title', isset($video) ? 'تعديل الفيديو' : 'إضافة فيديو جديد')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($video) ? 'تعديل الفيديو' : 'إضافة فيديو جديد' }}
  </h2>
  <a href="{{ route('admin.videos') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl">
  <form method="POST"
        action="{{ isset($video) ? route('admin.videos.update', $video['id'] ?? 1) : route('admin.videos.store') }}">
    @csrf @if(isset($video)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">النظام</label>
        <select name="platform" class="form-ctrl">
          <option value="youtube"  {{ ($video['platform'] ?? '') === 'youtube'  ? 'selected':'' }}>youtube</option>
          <option value="facebook" {{ ($video['platform'] ?? '') === 'facebook' ? 'selected':'' }}>facebook</option>
        </select>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">العنوان</label>
        <input name="title" type="text" value="{{ $video['title'] ?? '' }}" class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الرابط</label>
        <input name="url" type="url" value="{{ $video['url'] ?? '' }}" placeholder="https://..." class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المعرف</label>
        <input name="identifier" type="text" value="{{ $video['identifier'] ?? '' }}" class="form-ctrl"/>
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
