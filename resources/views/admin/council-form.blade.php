@extends('layouts.admin')
@section('title', isset($session) ? 'تعديل المجلس الإداري' : 'إضافة مجلس جديد')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($session) ? 'تعديل المجلس الإداري دورة '.($session['session'] ?? '').' '.($session['year'] ?? '') : 'إضافة مجلس جديد' }}
  </h2>
  <a href="{{ route('admin.council') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-2xl">
  <form method="POST"
        action="{{ isset($session) ? route('admin.council.update', $session['id'] ?? 1) : route('admin.council.store') }}"
        enctype="multipart/form-data">
    @csrf @if(isset($session)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">دورة</label>
        <input name="session" type="text" value="{{ $session['session'] ?? '' }}" placeholder="يناير" class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">السنة</label>
        <input name="year" type="number" value="{{ $session['year'] ?? '' }}" class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تاريخه</label>
        <input name="date" type="date" value="{{ $session['date'] ?? '' }}" class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">مكانه</label>
        <input name="place" type="text" value="{{ $session['place'] ?? '' }}" class="form-ctrl"/>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تقرير</label>
        <textarea name="report" class="form-ctrl" style="height:100px">{{ $session['report'] ?? '' }}</textarea>
      </div>
      <div>
        <label class="block text-slate-700 text-sm font-bold mb-2 text-right">صورة</label>
        @if(isset($session) && !empty($session['image']))
          <img src="{{ asset('storage/'.$session['image']) }}" class="h-28 rounded-md mb-2 object-cover"/>
        @endif
        <input name="image" type="file" accept="image/*" class="form-ctrl" style="padding:6px"/>
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
