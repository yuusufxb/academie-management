@extends('layouts.admin')
@section('title', 'تعديل المستخدم')
@section('page-title', 'تتبع الأنشطة')
@section('content')

    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-5" dir="rtl">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
            <h2 class="font-headline text-xl font-black text-[#0f2b26]">
                تعديل المستخدم: {{ $user['name'] ?? '' }}
            </h2>
        </div>
        <a href="{{ route('admin.users') }}"
            class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
        </a>
    </div>

    <div class="max-w-2xl" dir="rtl">
        <form method="POST" action="{{ route('admin.users.update', $user['id'] ?? 1) }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">

                {{-- Card Sub-header --}}
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#10b981] text-lg">manage_accounts</span>
                    <h3 class="font-headline font-black text-sm text-[#0f2b26]">تعديل بيانات الحساب</h3>
                </div>

                {{-- ... الجزء العلوي من الملف يبقى كما هو ... --}}

                <div class="p-6 space-y-5">

                    {{-- Name Input --}}
                    <div>
                        <label
                            class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">الاسم</label>
                        <input name="name" type="text" value="{{ old('name', $user->name) }}"
                            class="form-ctrl font-headline" required />
                    </div>

                    {{-- Email Input --}}
                    <div>
                        <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">البريد
                            الإلكتروني</label>
                        <input name="email" type="email" value="{{ old('email', $user->email) }}"
                            class="form-ctrl font-headline" style="text-align: left; direction: ltr;" required />
                    </div>

                    {{-- Level Input (تغيير الـ name لـ niv) --}}
                    <div>
                        <label
                            class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">المستوى
                            (niv)</label>
                        <input name="niv" id="input-niv-edit" type="number" value="{{ old('niv', $user->niv) }}" min="1"
                            max="6" class="form-ctrl font-headline" required />
                    </div>

                    {{-- gre / إقليم niv 5 (أكاديمية) أو gre عادي --}}
                    <div>
                        <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">رمز
                            المؤسسة (gre)</label>
                        @if(auth()->user()->hasLevel(\App\Models\User::LEVEL_PROVINCIAL_ADMIN))
                            <input name="gre" type="text" value="{{ old('gre', auth()->user()->gre) }}"
                                class="form-ctrl font-headline bg-slate-100" readonly />
                        @elseif(auth()->user()->hasLevel(\App\Models\User::LEVEL_ACADEMY_ADMIN))
                            <div id="wrap-cd-prov-edit" class="hidden">
                                <label class="block text-xs font-bold text-slate-500 mb-1 text-right">الإقليم</label>
                                <select name="cd_prov" id="select-cd-prov-edit" class="form-ctrl font-headline w-full">
                                    <option value="">— اختر الإقليم —</option>
                                    @foreach(($provinces ?? collect()) as $p)
                                        <option value="{{ $p->CD_PROV }}" {{ (string) old('cd_prov', $user->provinceCode() ?? '') === (string) $p->CD_PROV ? 'selected' : '' }}>
                                            {{ $p->LA_PROV ?? $p->CD_PROV }} ({{ $p->CD_PROV }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="wrap-gre-free-edit">
                                <input name="gre" id="input-gre-free-edit" type="text" value="{{ old('gre', $user->gre) }}"
                                    class="form-ctrl font-headline" />
                            </div>
                        @else
                            <input name="gre" type="text" value="{{ old('gre', $user->gre) }}"
                                class="form-ctrl font-headline" />
                        @endif
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-slate-50">
                        @if(auth()->user()->canFullyManageUsers())
                        {{-- زر الحذف --}}
                        <button type="button"
                            onclick="if(confirm('هل أنت متأكد من حذف هذا المستخدم؟')) document.getElementById('del-form').submit()"
                            class="px-6 py-2 bg-[#d9534f] text-white rounded-md font-headline font-black text-sm hover:bg-red-600 active:scale-95 transition-all shadow-sm">
                            حذف
                        </button>
                        @endif

                        {{-- زر التحديث --}}
                        <button type="submit"
                            class="px-8 py-2.5 bg-[#0f2b26] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                            تحديث
                        </button>
                    </div>  
                </div>

                {{-- ... بقية الملف والـ Hidden Form تبقى كما هي ... --}}
            </div>
        </form>

        @if(auth()->user()->canFullyManageUsers())
        {{-- Hidden Delete Form --}}
        <form id="del-form" method="POST" action="{{ route('admin.users.destroy', $user['id'] ?? 1) }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
        @endif
    </div>

@if(auth()->user()->hasLevel(\App\Models\User::LEVEL_ACADEMY_ADMIN))
@push('scripts')
<script>
(function () {
  const inputNiv = document.getElementById('input-niv-edit');
  const wrapProv = document.getElementById('wrap-cd-prov-edit');
  const wrapGre = document.getElementById('wrap-gre-free-edit');
  const selProv = document.getElementById('select-cd-prov-edit');
  const inputGre = document.getElementById('input-gre-free-edit');
  if (!inputNiv || !wrapProv || !wrapGre) return;

  function sync() {
    const n = parseInt(inputNiv.value, 10);
    if (n === 5) {
      wrapProv.classList.remove('hidden');
      wrapGre.classList.add('hidden');
      if (inputGre) { inputGre.removeAttribute('name'); inputGre.disabled = true; }
      if (selProv) { selProv.setAttribute('name', 'cd_prov'); selProv.disabled = false; }
    } else {
      wrapProv.classList.add('hidden');
      wrapGre.classList.remove('hidden');
      if (selProv) { selProv.removeAttribute('name'); selProv.disabled = true; }
      if (inputGre) { inputGre.setAttribute('name', 'gre'); inputGre.disabled = false; }
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
