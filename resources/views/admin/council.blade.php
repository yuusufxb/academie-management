@extends('layouts.admin')
@section('title', 'المجلس الإداري')
@section('page-title', 'المجلس الإداري')
@section('content')
<div class="flex items-center justify-between mb-4" dir="rtl">
  <h2 class="font-headline text-xl font-black text-slate-900">تتبع المجلس الإداري</h2>
  <a href="{{ route('admin.council.create') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة مجلس جديد</a>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden" dir="rtl">
  <table class="data-table w-full text-right">
    <thead>
        <tr><th>رت</th><th>الدورة</th><th>العام</th><th>تاريخه</th><th>مكانه</th><th>إجراءات</th></tr>
    </thead>
    <tbody>
      @forelse($councils as $council)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><span class="badge" style="background:#fef3c7;color:#b45309">{{ $council->mois }}</span></td>
          <td>{{ $council->yr }}</td>
          <td>{{ $council->dte }}</td>
          <td>{{ $council->lieu }}</td>
          <td>
            <div class="flex gap-1 justify-end">
              <a href="{{ route('admin.council.show', $council->id) }}" class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></a>
              <a href="{{ route('admin.council.edit', $council->id) }}" class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></a>
              <form action="{{ route('admin.council.destroy', $council->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                  @csrf @method('DELETE')
                  <button type="submit" class="icon-action" style="background:#fee2e2;color:#b91c1c"><span class="material-symbols-outlined text-sm">delete</span></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center py-10 text-slate-400">لا توجد بيانات مسجلة.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection