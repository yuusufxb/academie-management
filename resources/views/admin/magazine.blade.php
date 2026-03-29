@extends('layouts.admin')
@section('title', 'المجلة الشهرية')
@section('page-title', 'المجلة الشهرية')
@section('content')
<h2 class="font-headline text-xl font-black text-slate-900 mb-4">المجلة الشهرية — شذرات تربوية</h2>
<div class="bg-surface-container-lowest rounded-md p-5 mb-4">
  <form method="POST" action="{{ route('admin.magazine.generate') }}">
    @csrf
    <div class="grid grid-cols-3 gap-4 items-end">
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الشهر</label>
        <input name="month" class="form-ctrl" type="text" placeholder="December"/>
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">السنة</label>
        <input name="year" class="form-ctrl" type="text" placeholder="2024"/>
      </div>
      <button type="submit" class="bg-secondary text-white px-4 py-2.5 rounded-md text-sm font-bold active:scale-95">توليد وتحميل المجلة</button>
    </div>
  </form>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <div class="px-5 py-4 border-b border-slate-100"><h3 class="font-headline font-bold text-base">الأعداد السابقة</h3></div>
  <table class="data-table">
    <thead><tr><th>اسم الملف</th><th>التاريخ</th><th>الإجراءات</th></tr></thead>
    <tbody>
      @forelse($editions ?? [] as $ed)
        <tr>
          <td class="font-bold">{{ $ed->filename }}</td>
          <td>{{ $ed->created_at }}</td>
          <td>
            <div class="flex gap-1">
              <a href="{{ route('admin.magazine.view', $ed->id) }}" class="border border-slate-200 text-slate-700 px-3 py-1 rounded-md text-xs font-bold">عرض</a>
              <a href="{{ route('admin.magazine.download', $ed->id) }}" class="bg-secondary text-white px-3 py-1 rounded-md text-xs font-bold">تحميل</a>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="3" class="text-center py-8 text-slate-400">لا توجد أعداد سابقة.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
