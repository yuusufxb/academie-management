@extends('layouts.admin')
@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')
@section('content')
<h2 class="font-headline text-xl font-black text-slate-900 mb-4">إدارة المستخدمين</h2>
<div class="flex gap-3 mb-4">
  <input placeholder="بحث..." class="flex-1 bg-white border border-slate-200 rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 text-right font-body"/>
  <button class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold">إنشاء</button>
  <button class="border border-outline-variant text-primary px-4 py-2 rounded-md text-sm font-bold">تصدير (.xlsx)</button>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>#</th><th>الاسم</th><th>البريد الإلكتروني</th><th>المستوى</th><th>رمز المؤسسة</th><th>الإجراءات</th></tr></thead>
    <tbody>
      @forelse($users ?? [] as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td class="font-bold">{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->level ?? 1 }}</td>
          <td>{{ $user->institution_code ?? '—' }}</td>
          <td>
            <div class="flex gap-1 flex-wrap">
              <button class="border border-slate-200 text-slate-700 px-3 py-1 rounded-md text-xs font-bold hover:bg-slate-50">عرض</button>
              <button class="bg-secondary/10 text-secondary px-3 py-1 rounded-md text-xs font-bold hover:bg-secondary/20">تعديل</button>
              <button class="bg-amber-50 text-amber-700 px-3 py-1 rounded-md text-xs font-bold">إعادة التعيين</button>
              <button class="bg-slate-800 text-white px-3 py-1 rounded-md text-xs font-bold">إرسال بيانات الدخول</button>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center py-8 text-slate-400">لا يوجد مستخدمون.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
