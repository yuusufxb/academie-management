@extends('layouts.admin')
@section('title', 'تعديل المجلس الإداري')
@section('page-title', 'تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            تعديل المجلس الإداري : {{ $council->mois }} {{ $council->yr }}
        </h2>
    </div>
    <a href="{{ route('admin.council') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    {{-- تصحيح المسار واستخدام PUT --}}
    <form method="POST" action="{{ route('admin.council.update', $council->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden text-right">
            
            {{-- Card Sub-header - تصحيح العنوان هنا --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">تعديل بيانات المجلس</h3>
            </div>

            <div class="p-6 space-y-5">
                {{-- دورة --}}
                <div class="space-y-2">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">دورة</label>
                    <input name="mois" type="text" value="{{ old('mois', $council->mois) }}" 
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-[#10b981] focus:ring-4 focus:ring-[#10b981]/10 outline-none transition-all font-headline text-sm" required/>
                </div>

                {{-- السنة --}}
                <div class="space-y-2">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">السنة</label>
                    <input name="yr" type="number" value="{{ old('yr', $council->yr) }}" 
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-[#10b981] focus:ring-4 focus:ring-[#10b981]/10 outline-none transition-all font-headline text-sm" required/>
                </div>

                {{-- تاريخه --}}
                <div class="space-y-2">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">تاريخه</label>
                    <input name="dte" type="date" value="{{ old('dte', $council->dte) }}" 
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-[#10b981] focus:ring-4 focus:ring-[#10b981]/10 outline-none transition-all font-headline text-sm" required/>
                </div>

                {{-- مكانه --}}
                <div class="space-y-2">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">مكانه</label>
                    <input name="lieu" type="text" value="{{ old('lieu', $council->lieu) }}" 
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-[#10b981] focus:ring-4 focus:ring-[#10b981]/10 outline-none transition-all font-headline text-sm" required/>
                </div>

                {{-- تقرير --}}
                <div class="space-y-2">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">تقرير</label>
                    <textarea name="rap" rows="6" 
                              class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-[#10b981] focus:ring-4 focus:ring-[#10b981]/10 outline-none transition-all font-headline text-sm leading-relaxed" required>{{ old('rap', $council->rap) }}</textarea>
                </div>

                {{-- صورة --}}
                <div class="space-y-3">
                    <label class="block font-headline text-[#0f2b26] text-sm font-black">صورة المجلس</label>
                    
                    @if($council->tof)
                    <div class="relative w-48 group">
                        <img src="{{ photo_asset($council->tof) }}" class="w-48 h-32 object-cover rounded-xl border border-slate-200 shadow-sm"/>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">الصورة الحالية</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remove_tof"
                            id="remove_tof"
                            value="1"
                            class="w-4 h-4 rounded border border-slate-300 text-[#10b981] focus:ring-[#10b981]/30"
                        />
                        <label for="remove_tof" class="text-xs font-bold text-slate-600 cursor-pointer">
                            إزالة الصورة (بدون استبدال)
                        </label>
                    </div>
                    @endif
                    
                    <input name="tof" type="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#10b981]/10 file:text-[#10b981] hover:file:bg-[#10b981]/20 cursor-pointer"/>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-6 border-t border-slate-100">
                    <button type="submit" class="px-10 py-3 bg-[#0f2b26] text-white rounded-xl font-headline font-black text-sm hover:bg-[#1a423b] active:scale-95 transition-all shadow-lg shadow-[#0f2b26]/10">
                        تحديث البيانات
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection