@extends('layouts.admin')
@section('title', 'الأنشطة المبرمجة')
@section('page-title', 'الأنشطة المبرمجة')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">الأنشطة المبرمجة</h2>
  <a href="{{ route('admin.activities.schedule') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">+ برمجة نشاط جديد</a>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>رت</th><th>العنوان</th><th>النوع</th><th>تاريخ البرمجة</th><th>المكان</th><th>الحالة</th><th>إجراءات</th></tr></thead>
    <tbody>
      @forelse($programmed ?? [] as $act)
        <tr>
          <td>{{ $act->id }}</td>
          <td class="font-bold">{{ $act->title }}</td>
          <td><span class="badge" style="background:#ccfbf1;color:#0f766e">{{ $act->type }}</span></td>
          <td>{{ $act->scheduled_date }}</td>
          <td>{{ $act->place }}</td>
          <td>
            @if($act->status === 'مصادق')
              <span class="badge" style="background:#dcfce7;color:#166534">مصادق</span>
            @elseif($act->status === 'انتظار')
              <span class="badge" style="background:#fef3c7;color:#b45309">انتظار</span>
            @else
              <span class="badge" style="background:#f1f5f9;color:#64748b">مسودة</span>
            @endif
          </td>
          <td><div class="flex gap-1">
            <a href="{{ route('admin.activities.show', $act->id) }}" class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></a>
            <a href="{{ route('admin.activities.edit', $act->id) }}" class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></a>
          </div></td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center py-10 text-slate-400">لا توجد أنشطة مبرمجة.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
