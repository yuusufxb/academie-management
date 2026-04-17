@extends('layouts.admin')
@section('title', 'إنشاء مستخدم')
@section('page-title','تتبع الأنشطة')
@section('content')

@php
  $isProvincial = auth()->user()->hasLevel(\App\Models\User::LEVEL_PROVINCIAL_ADMIN);
  $isAcademy = auth()->user()->hasLevel(\App\Models\User::LEVEL_ACADEMY_ADMIN);
@endphp

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">
    إنشاء مستخدم
  </h2>
  <a href="{{ route('admin.users') }}" class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

<div class="max-w-lg">
  <form method="POST"
        action="{{ route('admin.users.store') }}"
        id="user-form-main">
    @csrf

    <div class="bg-white rounded-md shadow-sm overflow-hidden mb-4 border border-slate-100">
      <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/30">
        <p class="text-slate-700 text-sm font-bold text-right">
          إضافة حساب جديد
        </p>
      </div>
      <div class="px-5 py-5 space-y-5">

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الاسم</label>
          <input name="name" type="text" value="{{ old('name', '') }}"
                 class="form-ctrl text-right" required/>
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">البريد الإلكتروني</label>
          <input name="email" type="email" value="{{ old('email', '') }}"
                 class="form-ctrl text-left" dir="ltr" required/>
        </div>

        <div class="bg-emerald-50 border border-emerald-200 rounded-md px-3 py-2 text-right text-xs font-bold text-emerald-700">
          سيتم توليد كلمة المرور تلقائيا عند إنشاء الحساب.
        </div>

        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المستوى (niv)</label>
          <input name="niv" id="input-niv" type="number" value="{{ old('niv', 3) }}" min="1" max="6" class="form-ctrl text-right" required/>
        </div>

        @if($isProvincial)
        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رمز المؤسسة / الإقليم (gre)</label>
          <input name="gre" type="text" value="{{ old('gre', auth()->user()->gre ?? '') }}" class="form-ctrl text-right bg-slate-100" readonly />
          <p class="text-[11px] text-slate-500 mt-1 text-right">ثابت وفق صلاحيتك الإقليمية</p>
        </div>
        @elseif($isAcademy)
        {{-- مدير أكاديمية: عند niv=5 يختار الإقليم من z_prov (يُخزَّن في gre كـ CD_PROV) --}}
        <div id="wrap-cd-prov" class="hidden">
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الإقليم (province)</label>
          <select name="cd_prov" id="select-cd-prov" class="form-ctrl w-full text-right">
            <option value="">— اختر الإقليم —</option>
            @foreach(($provinces ?? collect()) as $p)
              <option value="{{ $p->CD_PROV }}" {{ (string) old('cd_prov', '') === (string) $p->CD_PROV ? 'selected' : '' }}>
                {{ $p->LA_PROV ?? $p->CD_PROV }} ({{ $p->CD_PROV }})
              </option>
            @endforeach
          </select>
          <p class="text-[11px] text-slate-500 mt-1 text-right">يُحفظ رمز الإقليم CD_PROV في حقل gre</p>
        </div>
        <div id="wrap-gre-free">
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رمز المؤسسة (gre)</label>
          <input name="gre" id="input-gre-free" type="text" value="{{ old('gre', '') }}" class="form-ctrl text-right" />
        </div>
        @else
        <div>
          <label class="block text-slate-700 text-sm font-bold mb-2 text-right">رمز المؤسسة (gre)</label>
          <input name="gre" type="text" value="{{ old('gre', '') }}" class="form-ctrl text-right"/>
        </div>
        @endif

      </div>

      <div class="px-5 py-4 border-t border-slate-100 flex justify-end gap-2 bg-slate-50/30">
        <a href="{{ route('admin.users') }}"
           class="px-4 py-2 border border-slate-200 text-slate-700 rounded-md text-sm font-bold hover:bg-slate-50 transition-all">إلغاء</a>

        <button type="submit"
                class="px-5 py-2 bg-emerald-600 text-white rounded-md text-sm font-bold hover:bg-emerald-500 active:scale-95 transition-all">إنشاء الحساب</button>
      </div>
    </div>
  </form>
</div>

@if($isAcademy)
@push('scripts')
<script>
(function () {
  const inputNiv = document.getElementById('input-niv');
  const wrapProv = document.getElementById('wrap-cd-prov');
  const wrapGre = document.getElementById('wrap-gre-free');
  const selProv = document.getElementById('select-cd-prov');
  const inputGre = document.getElementById('input-gre-free');
  if (!inputNiv || !wrapProv || !wrapGre) return;

  function sync() {
    const n = parseInt(inputNiv.value, 10);
    if (n === 5) {
      wrapProv.classList.remove('hidden');
      wrapGre.classList.add('hidden');
      if (inputGre) {
        inputGre.removeAttribute('name');
        inputGre.disabled = true;
      }
      if (selProv) {
        selProv.setAttribute('name', 'cd_prov');
        selProv.disabled = false;
      }
    } else {
      wrapProv.classList.add('hidden');
      wrapGre.classList.remove('hidden');
      if (selProv) {
        selProv.removeAttribute('name');
        selProv.disabled = true;
      }
      if (inputGre) {
        inputGre.setAttribute('name', 'gre');
        inputGre.disabled = false;
      }
    }
  }
  inputNiv.addEventListener('input', sync);
  inputNiv.addEventListener('change', sync);
  sync();
})();
</script>
@endpush
@endif
@endsection
