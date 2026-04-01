@extends('layouts.admin')
@section('title', 'تعديل المجلس الإداري')
@section('page-title', 'تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            تعديل المجلس الإداري دورة {{ $session['session'] ?? 'دجنبر' }} {{ $session['year'] ?? '2018' }}
        </h2>
    </div>
    <a href="{{ route('admin.council') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    <form method="POST" action="{{ route('admin.council.update', $session['id'] ?? 1) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Card Sub-header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit_document</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تحديث بيانات المجلس</h3>
            </div>

            <div class="p-6 space-y-4">
                {{-- Session (دورة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">دورة</label>
                    <input name="session" type="text" value="{{ old('session', $session['session'] ?? 'دجنبر') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Year (السنة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">السنة</label>
                    <input name="year" type="number" value="{{ old('year', $session['year'] ?? '2018') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Date (تاريخه) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تاريخه</label>
                    <input name="date" type="date" value="{{ old('date', $session['date'] ?? '2017-12-11') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Place (مكانه) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">مكانه</label>
                    <input name="place" type="text" value="{{ old('place', $session['place'] ?? 'مقر ولاية جهة سوس ماسة') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Report (تقرير) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تقرير</label>
                    <textarea name="report" rows="4" class="form-ctrl font-headline" required>{{ old('report', $session['report'] ?? 'المصادقة بالاجماع على مشروعي برنامج العمل والميزانية برسم السنة المالية 2018 في دورة المجلس الاداري للأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة.') }}</textarea>
                </div>

                {{-- Image (صورة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">صورة</label>
                    
                    {{-- Current Image Preview --}}
                    <div class="mb-3 text-right">
                        <img src="{{ asset('storage/' . ($session['image'] ?? 'images/default-council.jpg')) }}" 
                             alt="صورة المجلس" class="w-48 h-auto rounded-md border border-slate-200 shadow-sm object-cover inline-block"/>
                    </div>
                    
                    <input name="image" type="file" class="form-ctrl font-headline cursor-pointer" accept="image/*"/>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-5 mt-5">
                    <button type="submit" class="px-8 py-2.5 bg-[#10b981] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                        حفظ المعلومات
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection