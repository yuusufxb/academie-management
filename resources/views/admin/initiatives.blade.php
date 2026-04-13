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
    <thead>
      <tr>
        <th>رت</th>
        <th>المستوى</th>
        <th>العنوان</th>
        <th>تاريخ الإضافة</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @forelse($initiatives as $init)
        <tr>
          <td>{{ $init->id }}</td>
          <td>
            {{-- بما أن الموديل الجديد قد لا يحتوي على level، نضع قيمة افتراضية أو نستخدم الحقل إذا وجد --}}
            <span class="badge" style="{{ ($init->level ?? '') == 'جهوي' ? 'background:#dbeafe;color:#1d4ed8' : 'background:#dcfce7;color:#166534' }}">
              {{ $init->level ?? 'عام' }}
            </span>
          </td>
          <td class="font-bold">{{ $init->title }}</td>
          <td>{{ $init->created_at->format('Y-m-d') }}</td>
          <td>
            <div class="flex gap-1">
              {{-- رابط العرض الديناميكي --}}
              <a href="{{ route('admin.initiatives.show', $init->id) }}" class="icon-action" style="background:#dbeafe;color:#1d4ed8">
                <span class="material-symbols-outlined text-sm">search</span>
              </a>

              {{-- رابط التعديل الديناميكي --}}
              <a href="{{ route('admin.initiatives.edit', $init->id) }}" class="icon-action" style="background:#fef3c7;color:#b45309">
                <span class="material-symbols-outlined text-sm">edit</span>
              </a>

              {{-- زر الحذف الديناميكي مع Form --}}
              <form action="{{ route('admin.initiatives.destroy', $init->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه المبادرة؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-action" style="background:#fee2e2;color:#b91c1c">
                  <span class="material-symbols-outlined text-sm">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center py-10 text-slate-400">لا توجد مبادرات حالياً.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- إضافة الترقيم (Pagination) ليكون ديناميكياً --}}
<div class="mt-4">
    {{ $initiatives->links() }}
</div>
@endsection