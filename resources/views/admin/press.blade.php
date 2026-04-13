@extends('layouts.admin')
@section('title', 'القصاصات الصحفية')
@section('page-title', 'القصاصات الصحفية')

@section('content')
<div class="flex items-center justify-between mb-4" dir="rtl">
  <h2 class="font-headline text-xl font-black text-slate-900">القصاصات الصحفية</h2>
  <a href="{{ route('admin.press.create') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95 transition-transform">إضافة قصاصة جديدة</a>
</div>

<div class="bg-surface-container-lowest rounded-md overflow-hidden" dir="rtl">
  <table class="data-table w-full text-right">
    <thead>
      <tr class="bg-slate-50 border-b border-slate-100">
        <th class="p-4 text-xs font-black text-slate-500 uppercase">رت</th>
        <th class="p-4 text-xs font-black text-slate-500 uppercase">المنبر الإعلامي</th>
        <th class="p-4 text-xs font-black text-slate-500 uppercase">تاريخها</th>
        <th class="p-4 text-xs font-black text-slate-500 uppercase">عنوان المقال</th>
        <th class="p-4 text-xs font-black text-slate-500 uppercase text-left">إجراءات</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-50">
      @forelse($clippings as $clip)
        <tr class="hover:bg-slate-50/50 transition-colors">
          <td class="p-4 text-sm text-slate-600">{{ $loop->iteration }}</td>
          <td class="p-4">
            <span class="badge px-2 py-1 rounded text-xs font-bold" style="background:#dbeafe;color:#1d4ed8">
              {{ $clip->journal }}
            </span>
          </td>
          <td class="p-4 text-sm text-slate-700">{{ $clip->dte }}</td>
          <td class="p-4 text-sm font-bold text-slate-900">{{ $clip->titre }}</td>
          <td class="p-4 text-left">
            <div class="flex justify-start gap-1">
              <a href="{{ route('admin.press.show', $clip->id) }}" class="icon-action p-1 rounded-md" style="background:#dbeafe;color:#1d4ed8">
                <span class="material-symbols-outlined text-sm">search</span>
              </a>
              <a href="{{ route('admin.press.edit', $clip->id) }}" class="icon-action p-1 rounded-md" style="background:#fef3c7;color:#b45309">
                <span class="material-symbols-outlined text-sm">edit</span>
              </a>
              <form action="{{ route('admin.press.destroy', $clip->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                @csrf @method('DELETE')
                <button type="submit" class="icon-action p-1 rounded-md" style="background:#fee2e2;color:#b91c1c">
                  <span class="material-symbols-outlined text-sm">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="p-10 text-center text-slate-400 font-bold">لا توجد قصاصات صحفية حالياً.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection