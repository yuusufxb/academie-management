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
                        <input name="niv" type="number" value="{{ old('niv', $user->niv) }}" min="1"
                            max="3" class="form-ctrl font-headline" required />
                    </div>

                    {{-- Institution Code Input (تغيير الـ name لـ gre) --}}
                    <div>
                        <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">رمز
                            المؤسسة (gre)</label>
                        <input name="gre" type="text" value="{{ old('gre', $user->gre) }}"
                            class="form-ctrl font-headline" />
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-slate-50">
                        {{-- زر الحذف --}}
                        <button type="button"
                            onclick="if(confirm('هل أنت متأكد من حذف هذا المستخدم؟')) document.getElementById('del-form').submit()"
                            class="px-6 py-2 bg-[#d9534f] text-white rounded-md font-headline font-black text-sm hover:bg-red-600 active:scale-95 transition-all shadow-sm">
                            حذف
                        </button>

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

        {{-- Hidden Delete Form --}}
        <form id="del-form" method="POST" action="{{ route('admin.users.destroy', $user['id'] ?? 1) }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
