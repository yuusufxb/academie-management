@extends('layouts.admin')
@section('title', 'مكتبة الفيديو')
@section('page-title', 'مكتبة الفيديو')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">تتبع الفيديو</h2>
  <button class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة فيديو جديد</button>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>رت</th><th>النظام</th><th>العنوان</th><th>تاريخ الإضافة</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($videos ?? [] as $video)
        <tr>
          <td>{{ $video->id }}</td>
          <td><span class="badge" style="background:#fee2e2;color:#b91c1c">{{ $video->platform }}</span></td>
          <td class="font-bold">{{ $video->title }}</td>
          <td>{{ $video->created_at->format('Y-m-d') }}</td>
          <td><div class="flex gap-1">
            <button class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></button>
            <button class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></button>
            <button class="icon-action" style="background:#fee2e2;color:#b91c1c"><span class="material-symbols-outlined text-sm">delete</span></button>
          </div></td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center py-10 text-slate-400">لا توجد فيديوهات.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
