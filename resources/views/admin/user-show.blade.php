@extends('layouts.admin')
@section('title','تفاصيل المستخدم')
@section('page-title','تتبع الأنشطة')
@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-6" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">تفاصيل المستخدم</h2>
    </div>
    <a href="{{ route('admin.users') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="grid grid-cols-3 gap-6" dir="rtl">

    {{-- Activities panel --}}
    <div class="col-span-1 bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-2">
                <span class="font-headline text-xs font-black text-[#0f2b26]">الأنشطة</span>
                <span class="bg-[#10b981] text-white px-2 py-0.5 rounded-full text-[10px] font-black">{{ $user['activities_count'] ?? 58 }}</span>
            </div>
            <a href="{{ route('admin.activities.index') }}" class="text-[11px] text-[#10b981] font-black hover:underline">عرض الكل</a>
        </div>
        <div class="divide-y divide-slate-50">
            @foreach([
                ['date'=>'2026-02-28','title'=>'::: - ','resp'=>'Mohammed ait idir'],
                ['date'=>'2024-10-05','title'=>'زيارة تفقدية لمركز ثانوية أنوال التأهيلية بمدينة أكادير','resp'=>'الأكاديمية'],
                ['date'=>'2026-09-26','title'=>'كيف تسلك المدرسة ديناميكية التحول يقودها الفاعلون؟','resp'=>'السيدة وفاء شاكر مديرة'],
                ['date'=>'2024-09-06','title'=>'السيدة مديرة الاكاديمية تتشرف على استقبال التلاميذ','resp'=>'الأكاديمية'],
                ['date'=>'2024-09-05','title'=>'استقبال التلميذات والتلاميذ بالمدرسة الجماعاتية ادوز','resp'=>'الأكاديمية'],
            ] as $act)
            <div class="px-4 py-3 hover:bg-slate-50 transition-all cursor-pointer group text-right">
                <p class="text-[10px] text-slate-400 mb-1 group-hover:text-[#10b981] transition-colors">{{ $act['date'] }} — <span class="font-bold text-slate-500">{{ $act['resp'] }}</span></p>
                <p class="text-xs font-bold text-slate-700 line-clamp-2 leading-relaxed">{{ $act['title'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- User details panel --}}
    <div class="col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 bg-[#0f2b26]/5 text-[#0f2b26] rounded flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm">person</span>
                    </span>
                    <h3 class="font-headline font-black text-sm text-[#0f2b26]">بيانات الحساب</h3>
                </div>
                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-md text-[10px] font-black italic">المستخدم #{{ $user['id'] ?? 6142 }}</span>
            </div>

            {{-- Action buttons --}}
            <div class="px-5 py-3 border-b border-slate-100 flex gap-2 justify-start flex-wrap bg-slate-50/30">
                <a href="{{ route('admin.users.edit', $user['id'] ?? 1) }}"
                   class="px-4 py-1.5 bg-[#10b981] text-white rounded-lg text-xs font-black hover:opacity-90 transition-all">تعديل</a>
                <button class="px-4 py-1.5 bg-[#0f2b26] text-white rounded-lg text-xs font-black hover:opacity-90 transition-all">إعادة تعيين كلمة المرور</button>
                <button class="px-4 py-1.5 border border-slate-200 text-slate-700 rounded-lg text-xs font-black hover:bg-white transition-all">إرسال بيانات الدخول</button>
            </div>

            <div class="divide-y divide-slate-50">
                @foreach([
                  ['label'=>'ID :',                'value'=> $user['id'] ?? 6142],
                  ['label'=>'الاسم :',             'value'=> $user['name'] ?? 'Stagaire'],
                  ['label'=>'البريد الإلكتروني :', 'value'=> $user['email'] ?? 'stage@aref.sm'],
                  ['label'=>'المستوى (niv) :',      'value'=> $user['level'] ?? 1],
                  ['label'=>'رمز المؤسسة :',       'value'=> $user['institution_code'] ?? 1666],
                  ['label'=>'أنشئ في :',           'value'=> $user['created_at'] ?? '2026-03-24 19:48:55'],
                  ['label'=>'آخر تعديل :',          'value'=> $user['updated_at'] ?? '2026-03-24 19:48:55'],
                ] as $row)
                {{-- Fixed Alignment: Grouped to the right --}}
                <div class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                    <p class="font-headline text-[#0f2b26] text-sm font-black min-w-[140px] text-right ml-4">{{ $row['label'] }}</p>
                    <p class="text-slate-700 text-sm font-medium flex-1 text-right">{{ $row['value'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection