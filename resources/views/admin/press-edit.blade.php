@extends('layouts.admin')
@section('title', isset($clipping) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            {{ isset($clipping) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية' }}
        </h2>
    </div>
    <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    <form method="POST" 
          action="{{ isset($clipping) ? route('admin.press.update', $clipping->id) : route('admin.press.store') }}" 
          enctype="multipart/form-data">
        @csrf 
        @if(isset($clipping)) @method('PUT') @endif
        
        <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden text-right">
            
            {{-- Card Sub-header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit_document</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تحديث بيانات القصاصة</h3>
            </div>

            <div class="p-6 space-y-4">
                {{-- Newspaper (المنبر الإعلامي) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">المنبر الإعلامي (الصحيفة)</label>
                    <input name="journal" type="text" value="{{ old('journal', $clipping->journal ?? '') }}" class="form-ctrl font-headline w-full" required/>
                    @error('journal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Date (تاريخها) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">تاريخ النشر</label>
                    <input name="dte" type="date" value="{{ old('dte', $clipping->dte ?? '') }}" class="form-ctrl font-headline w-full" required/>
                    @error('dte') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Title (عنوان المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">عنوان المقال</label>
                    <input name="titre" type="text" value="{{ old('titre', $clipping->titre ?? '') }}" class="form-ctrl font-headline w-full" required/>
                    @error('titre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Link (رابط المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">رابط المقال (إن وجد)</label>
                    <input name="lien" type="url" value="{{ old('lien', $clipping->lien ?? '') }}" placeholder="https://..." class="form-ctrl font-headline w-full" style="text-align: left; direction: ltr;"/>
                    @error('lien') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Image (تحميل الصور) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">صورة القصاصة</label>
                    
                    @if(isset($clipping->photo))
                    <div class="mb-3">
                        <img src="{{ photo_asset($clipping->photo) }}" alt="صورة القصاصة" class="w-48 h-auto rounded-md border border-slate-200 shadow-sm object-cover inline-block"/>
                        <p class="text-[10px] text-slate-400 mt-1 italic">الصورة الحالية</p>
                    </div>
                    @endif
                    
                    <input name="photo" type="file" class="form-ctrl font-headline cursor-pointer w-full" accept="image/*"/>
                    @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Content (المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2">محتوى المقال</label>
                    <textarea name="txt" rows="6" class="form-ctrl font-headline w-full">{{ old('txt', $clipping->txt ?? '') }}</textarea>
                    @error('txt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-5 mt-5 border-t border-slate-50">
                    <button type="submit" class="px-8 py-2.5 bg-[#10b981] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                        {{ isset($clipping) ? 'حفظ التغييرات' : 'إضافة القصاصة' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection