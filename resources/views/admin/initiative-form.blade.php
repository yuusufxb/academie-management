@extends('layouts.admin')
@section('title', isset($initiative) ? 'تعديل المبادرة الجهوية' : 'إضافة مبادرة جديدة')
@section('page-title', 'تتبع الأنشطة')
@section('content')

    <div class="flex items-center justify-between mb-5">
        <h2 class="font-headline text-xl font-black text-slate-900">
            {{-- استخدام isset للتأكد من وجود المتغير قبل استخدامه --}}
            {{ isset($initiative) ? 'تعديل المبادرة' : 'إضافة مبادرة جديدة' }}
        </h2>
        <a href="{{ route('admin.initiatives') }}"
            class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
        </a>
    </div>

    <div class="max-w-2xl">
        <form method="POST" {{-- هنا يكمن الحل: التحقق قبل طلب الـ ID --}}
            action="{{ isset($initiative) ? route('admin.initiatives.update', $initiative->id) : route('admin.initiatives.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($initiative))
                @method('PUT')
            @endif

            <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

                {{-- المستوى --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المستوى</label>
                    <select name="level" class="form-ctrl">
                        <option value="جهوي"
                            {{ isset($initiative) && $initiative->level === 'جهوي' ? 'selected' : '' }}>جهوي</option>
                        <option value="إقليمي"
                            {{ isset($initiative) && $initiative->level === 'إقليمي' ? 'selected' : '' }}>إقليمي</option>
                        <option value="محلي"
                            {{ isset($initiative) && $initiative->level === 'محلي' ? 'selected' : '' }}>محلي</option>
                    </select>
                </div>

                {{-- العنوان --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">العنوان</label>
                    <input name="title" type="text" value="{{ old('title', $initiative->title ?? '') }}"
                        class="form-ctrl" required />
                </div>

                {{-- التقرير --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">تقرير</label>
                    <textarea name="report" class="form-ctrl" style="height:120px" required>{{ old('report', $initiative->rap ?? '') }}</textarea>
                </div>

                {{-- الصورة --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">صورة</label>
                    @if (isset($initiative) && !empty($initiative->image))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $initiative->image) }}"
                                class="h-28 rounded-md object-cover border" />
                        </div>
                    @endif
                    <input name="image" type="file" accept="image/*" class="form-ctrl" style="padding:6px" />
                </div>

                <div class="flex justify-end pt-2 border-t border-slate-100">
                    <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
                        {{ isset($initiative) ? 'تحديث المعلومات' : 'حفظ المعلومات' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
