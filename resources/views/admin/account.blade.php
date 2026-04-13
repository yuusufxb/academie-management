@extends('layouts.admin')
@section('title', 'الحساب')
@section('page-title', 'الحساب')

@section('content')
<h2 class="font-headline text-xl font-black text-slate-900 mb-4 text-right">معلومات الحساب</h2>

<div class="bg-surface-container-lowest rounded-md shadow-sm overflow-hidden max-w-lg border border-slate-100" dir="rtl">
  {{-- رأس البطاقة - Profile Header --}}
  <div class="p-5 border-b border-slate-100 flex items-center gap-4 bg-slate-50/50">
    <div class="w-14 h-14 bg-emerald-600 rounded-full flex items-center justify-center text-2xl font-black text-white shadow-sm">
      {{ mb_substr(auth()->user()->name, 0, 1) }}
    </div>
    <div class="text-right">
      <p class="font-headline font-black text-lg text-slate-900">{{ auth()->user()->name }}</p>
      <div class="flex items-center gap-1.5">
          <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
          <p class="text-xs text-slate-400 font-bold">مستخدم نشط</p>
      </div>
    </div>
  </div>

  <div class="p-6">
    {{-- بيانات المستخدم --}}
    <div class="mb-4 text-right">
      <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">اسم المستخدم</p>
      <p class="font-bold text-slate-900 mt-1">{{ auth()->user()->name }}</p>
    </div>
    
    <div class="mb-6 text-right">
      <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">البريد الإلكتروني</p>
      <p class="text-slate-600 mt-1 font-medium">{{ auth()->user()->email }}</p>
    </div>

    {{-- قسم تغيير كلمة المرور --}}
    <div class="border-t border-slate-100 pt-6">
      <div class="flex items-center gap-2 mb-4">
          <span class="material-symbols-outlined text-slate-400 text-lg">lock_reset</span>
          <p class="text-sm font-black text-slate-800">تغيير القن السري</p>
      </div>

      {{-- رسالة النجاح --}}
      @if(session('password_updated'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md mb-4 text-sm font-bold flex items-center gap-2">
          <span class="material-symbols-outlined text-base">check_circle</span>
          تم تغيير القن السري بنجاح!
        </div>
      @endif

      {{-- رسائل الأخطاء --}}
      @if($errors->any())
        <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-md mb-4 text-xs font-bold">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.account.password') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block text-xs font-black text-slate-500 uppercase mb-1.5 text-right">الرمز السري الحالي</label>
          <input name="current_password" class="form-ctrl text-left" dir="ltr" type="password" required/>
        </div>
        
        <div>
          <label class="block text-xs font-black text-slate-500 uppercase mb-1.5 text-right">القن السري الجديد</label>
          <input name="new_password" class="form-ctrl text-left" dir="ltr" type="password" required/>
        </div>
        
        <div>
          <label class="block text-xs font-black text-slate-500 uppercase mb-1.5 text-right">تأكيد القن السري الجديد</label>
          <input name="new_password_confirmation" class="form-ctrl text-left" dir="ltr" type="password" required/>
        </div>

        <div class="flex justify-end mt-6">
          <button type="submit" class="bg-[#0f2b26] text-white px-8 py-2.5 rounded-md font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
            تحديث القن السري
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection