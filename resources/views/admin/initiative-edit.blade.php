@extends('layouts.admin')
@section('title', isset($initiative) ? 'تعديل المبادرة الجهوية' : 'إضافة مبادرة جديدة')
@section('page-title', 'تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            {{ isset($initiative) ? ($initiative['title'] ?? 'تعديل المبادرة') : 'إضافة مبادرة جديدة' }}
        </h2>
    </div>
    <a href="{{ route('admin.initiatives') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    <form method="POST" 
          action="{{ isset($initiative) ? route('admin.initiatives.update', $initiative['id'] ?? 1) : route('admin.initiatives.store') }}" 
          enctype="multipart/form-data">
        @csrf 
        @if(isset($initiative)) @method('PUT') @endif
        
        <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Card Sub-header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit_note</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تحديث بيانات المبادرة</h3>
            </div>

            <div class="p-6 space-y-4">
                {{-- Level (المستوى) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">المستوى</label>
                    <select name="level" class="form-ctrl font-headline cursor-pointer">
                        <option value="جهوي" {{ (old('level', $initiative['level'] ?? '')) === 'جهوي' ? 'selected' : '' }}>جهوي</option>
                        <option value="محلي" {{ (old('level', $initiative['level'] ?? '')) === 'محلي' ? 'selected' : '' }}>محلي</option>
                        <option value="وطني" {{ (old('level', $initiative['level'] ?? '')) === 'وطني' ? 'selected' : '' }}>وطني</option>
                    </select>
                </div>

                {{-- Title (العنوان) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">العنوان</label>
                    <input name="title" type="text" value="{{ old('title', $initiative['title'] ?? '') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Report (تقرير) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تقرير</label>
                    <textarea name="report" rows="5" class="form-ctrl font-headline" required>{{ old('report', $initiative['report'] ?? '') }}</textarea>
                </div>

                {{-- Image (صورة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">صورة المبادرة</label>
                    
                    {{-- Current Image Preview from Structure --}}
                    @if(isset($initiative) && !empty($initiative['image']))
                    <div class="mb-3 text-right">
                        <img src="{{ asset('storage/'.$initiative['image']) }}" 
                             alt="صورة المبادرة" 
                             class="w-full max-h-80 rounded-md border border-slate-200 shadow-sm object-cover inline-block"/>
                    </div>
                    @endif
                    
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