@extends('layouts.admin')
@section('title', isset($video) ? 'تعديل الفيديو' : 'إضافة فيديو جديد')
@section('page-title', 'تتبع الأنشطة')
@section('content')

    <div class="flex items-center justify-between mb-5">
        <h2 class="font-headline text-xl font-black text-slate-900">
            {{ isset($video) ? 'تعديل الفيديو' : 'إضافة فيديو جديد' }}
        </h2>
        <a href="{{ route('admin.videos') }}"
            class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
        </a>
    </div>

    <div class="max-w-2xl">
        <form method="POST"
            action="{{ isset($video) ? route('admin.videos.update', $video->id) : route('admin.videos.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($video))
                @method('PUT')
            @endif

            <div class="bg-white rounded-md shadow-sm p-6 space-y-5">

                {{-- النوع / المنصة --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">النظام (المنصة)</label>
                    <select name="typ" class="form-ctrl">
                        <option value="1" {{ old('typ', $video->typ ?? '') == '1' ? 'selected' : '' }}>YouTube
                        </option>
                        <option value="2" {{ old('typ', $video->typ ?? '') == '2' ? 'selected' : '' }}>FaceBook
                        </option>
                        <option value="3" {{ old('typ', $video->typ ?? '') == '3' ? 'selected' : '' }}>نشاط آخر
                        </option>
                    </select>
                </div>

                {{-- العنوان --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">العنوان</label>
                    <input name="title" type="text" value="{{ old('title', $video->title ?? '') }}" class="form-ctrl"
                        placeholder="عنوان الفيديو..." required />
                </div>

                {{-- الرابط --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الرابط</label>
                    <input name="link" type="url" value="{{ old('link', $video->link ?? '') }}"
                        placeholder="https://..." class="form-ctrl" required />
                </div>

                {{-- المعرف (tof) --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المعرف</label>

                    <input name="tof" type="text" value="{{ old('tof', $video->tof ?? '') }}" class="form-ctrl"
                         />
                    
                </div>



                <div class="flex justify-end pt-2 border-t border-slate-100">
                    <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
                        {{ isset($video) ? 'تحديث البيانات' : 'حفظ المعلومات' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
