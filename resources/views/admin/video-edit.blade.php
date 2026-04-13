@extends('layouts.admin')
@section('title', 'تعديل الفيديو')
@section('page-title', 'تتبع الأنشطة')
@section('content')

    <div class="flex items-center justify-between mb-5">
        <h2 class="font-headline text-xl font-black text-slate-900">تعديل الفيديو</h2>
        <a href="{{ route('admin.videos') }}"
            class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
        </a>
    </div>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.videos.update', $video->id) }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-md shadow-sm p-6 space-y-5">
                {{-- النظام --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">النظام</label>
                    <select name="typ" class="form-ctrl">
                        <option value="YouTube" {{ $video->typ == 1 || $video->typ == 'YouTube' ? 'selected' : '' }}>YouTube
                        </option>
                        <option value="FaceBook" {{ $video->typ == 2 || $video->typ == 'FaceBook' ? 'selected' : '' }}>
                            FaceBook</option>
                    </select>
                </div>

                {{-- العنوان --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">العنوان</label>
                    <input name="title" type="text" value="{{ old('title', $video->title) }}" class="form-ctrl"
                        required />
                </div>

                {{-- الرابط --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">الرابط</label>
                    <input name="link" type="url" value="{{ old('link', $video->link) }}" class="form-ctrl"
                        required />
                </div>

                {{-- المعرف (tof) --}}
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2 text-right">المعرف</label>
                    <input name="tof" type="text" value="{{ old('tof', $video->tof) }}" class="form-ctrl" />
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100 gap-2">
                    <a href="{{ route('admin.videos') }}"
                        class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-md font-bold text-sm hover:bg-slate-200">إلغاء</a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-emerald-600 text-white rounded-md font-bold text-sm hover:bg-emerald-500 active:scale-95 transition-all">
                        حفظ التعديلات
                    </button>
                </div>


            </div>
        </form>
    </div>
@endsection
