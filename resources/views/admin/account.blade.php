@extends('layouts.admin')
@section('title', 'الحساب')
@section('page-title', 'الحساب')

@section('content')
<h2 class="font-headline text-xl font-black text-slate-900 mb-4">معلومات الحساب</h2>
<div class="bg-surface-container-lowest rounded-md overflow-hidden max-w-lg">
  <div class="p-5 border-b border-slate-100 flex items-center gap-4 bg-slate-50">
    <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center text-xl font-black text-white">
      {{ mb_substr(auth()->user()->name ?? 'S', 0, 1) }}
    </div>
    <div>
      <p class="font-headline font-bold text-base text-slate-900">{{ auth()->user()->name ?? 'Stagaire' }}</p>
      <p class="text-xs text-slate-400">مستخدم نشط</p>
    </div>
  </div>
  <div class="p-6">
    <div class="mb-4">
      <p class="text-xs font-bold text-slate-500 uppercase">المستعمل</p>
      <p class="font-bold text-slate-900 mt-1">{{ auth()->user()->name ?? 'Stagaire' }}</p>
    </div>
    <div class="mb-6">
      <p class="text-xs font-bold text-slate-500 uppercase">البريد الإلكتروني</p>
      <p class="text-slate-600 mt-1">{{ auth()->user()->email ?? '••••••••' }}</p>
    </div>
    <div class="border-t border-slate-100 pt-5">
      <p class="text-sm font-bold text-slate-800 mb-4">تغيير القن السري</p>
      @if(session('password_updated'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md mb-4 text-sm font-bold">تم تغيير القن السري بنجاح!</div>
      @endif
      <form method="POST" action="{{ route('admin.account.password') }}" class="space-y-3">
        @csrf
        <div>
          <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">الرمز السري الحالي</label>
          <input name="current_password" class="form-ctrl" type="password"/>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">القن السري الجديد</label>
          <input name="new_password" class="form-ctrl" type="password"/>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">تأكيد القن السري</label>
          <input name="new_password_confirmation" class="form-ctrl" type="password"/>
        </div>
        <div class="flex justify-end mt-4">
          <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-md font-bold text-sm hover:shadow-md active:scale-95">تغيير القن السري</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
