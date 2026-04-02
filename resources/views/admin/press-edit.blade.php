@extends('layouts.admin')
@section('title', isset($press) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            {{ isset($press) ? 'تعديل القصاصة الصحفية' : 'إضافة القصاصة الصحفية' }}
        </h2>
    </div>
    <a href="{{ route('admin.press') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    <form method="POST" 
          action="{{ isset($press) ? route('admin.press.update', $press['id'] ?? 1) : route('admin.press.store') }}" 
          enctype="multipart/form-data">
        @csrf 
        @if(isset($press)) @method('PUT') @endif
        
        <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Card Sub-header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit_document</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تحديث بيانات القصاصة</h3>
            </div>

            <div class="p-6 space-y-4">
                {{-- Newspaper (الصحيفة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">الصحيفة</label>
                    <input name="media_outlet" type="text" value="{{ old('media_outlet', $press['media_outlet'] ?? 'الاتحاد الاشتراكي') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Date (تاريخها) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تاريخها</label>
                    <input name="publish_date" type="date" value="{{ old('publish_date', $press['publish_date'] ?? '2024-04-16') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Title (عنوان المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">عنوان المقال</label>
                    <input name="title" type="text" value="{{ old('title', $press['title'] ?? 'أكادير: لقاء تواصلي حول المنصة الرقمية الجهوية «أنشطتي»') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Link (رابط المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">رابط المقال</label>
                    <input name="url" type="url" value="{{ old('url', $press['url'] ?? '') }}" placeholder="https://..." class="form-ctrl font-headline" style="text-align: left; direction: ltr;"/>
                </div>

                {{-- Image (تحميل الصور) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تحميل الصور</label>
                    
                    {{-- Current Image Preview (if editing) --}}
                    @if(isset($press['image']))
                    <div class="mb-3 text-right">
                        <img src="{{ asset('storage/' . $press['image']) }}" alt="صورة القصاصة" class="w-48 h-auto rounded-md border border-slate-200 shadow-sm object-cover inline-block"/>
                    </div>
                    @endif
                    
                    <input name="image" type="file" class="form-ctrl font-headline cursor-pointer" accept="image/*"/>
                </div>

                {{-- Content (المقال) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">المقال</label>
                    <textarea name="content" rows="6" class="form-ctrl font-headline" required>{{ old('content', $press['content'] ?? 'انطلقت يوم الاثنين 15 ابريل 2024 بالمركز الجهوي للتكوين المستمر محمد الزرقطوني بأكادير، اللقاءات التواصلية لتعميم استعمال المنصة الرقمية الجهوية...') }}</textarea>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-5 mt-5">
                    <button type="submit" class="px-8 py-2.5 bg-[#10b981] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                        حفظ التغييرات
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection