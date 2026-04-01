@extends('layouts.admin')
@section('title', isset($user) ? 'تعديل المستخدم' : 'إنشاء مستخدم')
@section('page-title','تتبع الأنشطة')
@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    {{ isset($user) ? 'تعديل المستخدم' : 'إنشاء مستخدم' }}
  </h2>
  <a href="{{ route('admin.users') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-lg">
  <form method="POST"
        action="{{ isset($user) ? route('admin.users.update', $user['id'] ?? 1) : route('admin.users.store') }}">
    @csrf @if(isset($user)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm overflow-hidden mb-4">
      <div class="px-5 py-4 border-b border-slate-100">
        <p class="text-slate-700 text-sm font-bold text-right">
          {{ isset($user) ? 'تعديل المستخدم' : 'إنشاء مستخدم' }}
        </p>
      </div>
      <div class="px-5 py-5 space-y-5">

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الاسم</label>
          <input name="name" type="text" value="{{ $user['name'] ?? '' }}"
                 placeholder="{{ isset($user) ? ($user['name'] ?? '') : '' }}" class="form-ctrl"/>
        </div>

        @if(!isset($user))
        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">اسم المستخدم</label>
          <input name="username" type="text" class="form-ctrl"/>
        </div>
        @endif

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">البريد الإلكتروني</label>
          <input name="email" type="email" value="{{ $user['email'] ?? '' }}" class="form-ctrl"/>
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المستوى</label>
          <input name="level" type="number" value="{{ $user['level'] ?? 3 }}" min="1" max="3" class="form-ctrl"/>
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رمز المؤسسة</label>
          <input name="institution_code" type="text" value="{{ $user['institution_code'] ?? '' }}" class="form-ctrl"/>
        </div>

      </div>

      <div class="px-5 py-4 border-t border-slate-100 flex justify-end gap-2">
        <a href="{{ route('admin.users') }}"
           class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-bold hover:bg-slate-50 transition-all">إلغاء</a>
        @if(isset($user))
          <button type="submit"
                  class="px-5 py-2 bg-emerald-600 text-white rounded-md text-sm font-bold hover:bg-emerald-500 active:scale-95 transition-all">تحديث</button>
          <button type="button" onclick="if(confirm('هل أنت متأكد؟'))document.getElementById('del-form').submit()"
                  class="px-5 py-2 bg-red-500 text-white rounded-md text-sm font-bold hover:bg-red-400 active:scale-95 transition-all">حذف</button>
        @else
          <button type="submit"
                  class="px-5 py-2 bg-emerald-600 text-white rounded-md text-sm font-bold hover:bg-emerald-500 active:scale-95 transition-all">إنشاء وإرسال بيانات الدخول</button>
        @endif
      </div>
    </div>
  </form>

  @if(isset($user))
  <form id="del-form" method="POST" action="{{ route('admin.users.destroy', $user['id'] ?? 1) }}">
    @csrf @method('DELETE')
  </form>
  @endif

</div>
@endsection
