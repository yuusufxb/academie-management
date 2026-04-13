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
        action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
    @csrf @if(isset($user)) @method('PUT') @endif

    <div class="bg-white rounded-md shadow-sm overflow-hidden mb-4 border border-slate-100">
      <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/30">
        <p class="text-slate-700 text-sm font-bold text-right">
          {{ isset($user) ? 'تعديل بيانات الحساب' : 'إضافة حساب جديد' }}
        </p>
      </div>
      <div class="px-5 py-5 space-y-5">

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الاسم</label>
          <input name="name" type="text" value="{{ old('name', $user->name ?? '') }}"
                 class="form-ctrl text-right" required/>
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">البريد الإلكتروني</label>
          <input name="email" type="email" value="{{ old('email', $user->email ?? '') }}" 
                 class="form-ctrl text-left" dir="ltr" required/>
        </div>

        {{-- حقل كلمة المرور يظهر فقط عند الإنشاء --}}
        @if(!isset($user))
        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">كلمة المرور</label>
          <input name="password" type="password" class="form-ctrl text-left" dir="ltr" required/>
        </div>
        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تأكيد كلمة المرور</label>
          <input name="password_confirmation" type="password" class="form-ctrl text-left" dir="ltr" required/>
        </div>
        @endif

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المستوى (niv)</label>
          <input name="niv" type="number" value="{{ old('niv', $user->niv ?? 3) }}" min="1" max="3" class="form-ctrl text-right"/>
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رمز المؤسسة (gre)</label>
          <input name="gre" type="text" value="{{ old('gre', $user->gre ?? '') }}" class="form-ctrl text-right"/>
        </div>

      </div>

      <div class="px-5 py-4 border-t border-slate-100 flex justify-end gap-2 bg-slate-50/30">
        <a href="{{ route('admin.users') }}"
           class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-bold hover:bg-slate-50 transition-all">إلغاء</a>
        
        @if(isset($user))
          <button type="submit"
                  class="px-5 py-2 bg-emerald-600 text-white rounded-md text-sm font-bold hover:bg-emerald-500 active:scale-95 transition-all">تحديث</button>
        @else
          <button type="submit"
                  class="px-5 py-2 bg-emerald-600 text-white rounded-md text-sm font-bold hover:bg-emerald-500 active:scale-95 transition-all">إنشاء الحساب</button>
        @endif
      </div>
    </div>
  </form>
</div>
@endsection