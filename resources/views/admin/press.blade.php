@extends('layouts.admin')
@section('title', 'القصاصات الصحفية')
@section('page-title', 'القصاصات الصحفية')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">القصاصات الصحفية</h2>
  <a href="{{ route('admin.press.create') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة قصاصة جديدة</a>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>رت</th><th>المصدر</th><th>العنوان</th><th>تاريخ النشر</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($clippings ?? [] as $clip)
        <tr>
          <td>{{ $clip->id }}</td>
          <td><span class="badge" style="background:#dbeafe;color:#1d4ed8">{{ $clip->source }}</span></td>
          <td class="font-bold">{{ $clip->title }}</td>
          <td>{{ $clip->published_at }}</td>
          <td><div class="flex gap-1">
            <a href="{{ route('admin.press.show') }}" class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></a>
            <a href="{{ route('admin.press.edit') }}" class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></a>
            <button class="icon-action" style="background:#fee2e2;color:#b91c1c"><span class="material-symbols-outlined text-sm">delete</span></button>
          </div></td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center py-10 text-slate-400">لا توجد قصاصات.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
