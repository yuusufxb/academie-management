@extends('layouts.admin')
@section('title', 'مبادرات جهوية')
@section('page-title', 'مبادرات جهوية')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">تتبع المبادرات الجهوية المتميزة</h2>
  <a href="{{ route('admin.initiatives.create') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة مبادرة جديدة</a>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>رت</th><th>المستوى</th><th>العنوان</th><th>تاريخ الإضافة</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($initiatives ?? [] as $init)
        <tr>
          <td>{{ $init->id }}</td>
          <td>
            <span class="badge" style="{{ $init->level=='جهوي' ? 'background:#dbeafe;color:#1d4ed8' : 'background:#dcfce7;color:#166534' }}">{{ $init->level }}</span>
          </td>
          <td class="font-bold">{{ $init->title }}</td>
          <td>{{ $init->created_at->format('Y-m-d') }}</td>
          <td><div class="flex gap-1">
            <a href="{{ route('admin.initiatives-show') }}" class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></a>
            <a class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></a>
            <button class="icon-action" style="background:#fee2e2;color:#b91c1c"><span class="material-symbols-outlined text-sm">delete</span></button>
          </div></td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center py-10 text-slate-400">لا توجد مبادرات.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
