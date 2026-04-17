@extends('layouts.admin')
@section('title', isset($initiative) ? 'تعديل المبادرة الجهوية' : 'إضافة مبادرة جديدة')
@section('page-title', 'تتبع الأنشطة')
@section('content')

{{-- Header Section --}}
<div class="flex items-center justify-between mb-5" dir="rtl">
    <div class="flex items-center gap-3">
        <div class="w-1.5 h-8 rounded-full bg-[#10b981]"></div>
        <h2 class="font-headline text-xl font-black text-[#0f2b26]">
            {{ isset($initiative) ? 'تعديل المبادرة' : 'إضافة مبادرة جديدة' }}
        </h2>
    </div>
    <a href="{{ route('admin.initiatives') }}" class="flex items-center gap-1 text-slate-500 hover:text-[#0f2b26] text-sm font-bold transition-colors">
        <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
    </a>
</div>

<div class="max-w-3xl" dir="rtl">
    <form method="POST" 
          action="{{ isset($initiative) ? route('admin.initiatives.update', $initiative->id) : route('admin.initiatives.store') }}" 
          enctype="multipart/form-data">
        @csrf 
        @if(isset($initiative)) @method('PUT') @endif
        
        <div class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Card Sub-header --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#10b981] text-lg">edit_note</span>
                <h3 class="font-headline font-black text-sm text-[#0f2b26]">
                    {{ isset($initiative) ? 'تحديث بيانات المبادرة' : 'إدخال بيانات المبادرة' }}
                </h3>
            </div>

            <div class="p-6 space-y-4">
                {{-- Level (المستوى) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">المستوى</label>
                    <select name="level" class="form-ctrl font-headline cursor-pointer">
                        <option value="جهوي" {{ (old('level', $initiative->level ?? '')) === 'جهوي' ? 'selected' : '' }}>جهوي</option>
                        <option value="إقليمي" {{ (old('level', $initiative->level ?? '')) === 'إقليمي' ? 'selected' : '' }}>إقليمي</option>
                        <option value="محلي" {{ (old('level', $initiative->level ?? '')) === 'محلي' ? 'selected' : '' }}>محلي</option>
                    </select>
                </div>

                {{-- Title (العنوان) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">العنوان</label>
                    <input name="title" type="text" value="{{ old('title', $initiative->title ?? '') }}" class="form-ctrl font-headline" required/>
                </div>

                {{-- Report (تقرير) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">تقرير</label>
                    {{-- نستخدم rap لأنه الحقل المقابل في الموديل الجديد --}}
                    <textarea name="report" rows="5" class="form-ctrl font-headline" required>{{ old('report', $initiative->rap ?? '') }}</textarea>
                </div>

                {{-- Image (صورة) --}}
                <div>
                    <label class="block font-headline text-slate-500 text-xs font-bold uppercase mb-2 text-right">صور المبادرة</label>

                    @php
                        $existingCount = isset($initiative) && $initiative->relationLoaded('photos')
                            ? $initiative->photos->count()
                            : (isset($initiative) && isset($initiative->photos) ? $initiative->photos->count() : 0);
                    @endphp

                    @if(isset($initiative) && $existingCount > 0)
                        <div class="grid grid-cols-3 gap-3 mb-4" id="existing-photos">
                            @foreach($initiative->photos as $photo)
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-50"
                                     id="photo-wrapper-{{ $photo->id }}">
                                    <img src="{{ photo_asset($photo->path) }}"
                                         alt="{{ $photo->name }}"
                                         class="w-full h-28 object-cover">

                                    <button type="button"
                                            onclick="markRemove({{ $photo->id }}, this)"
                                            class="absolute top-1 left-1 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow transition-all opacity-0 group-hover:opacity-100">
                                        <span class="material-symbols-outlined text-sm">close</span>
                                    </button>

                                    <div id="remove-overlay-{{ $photo->id }}"
                                         class="hidden absolute inset-0 bg-red-500/60 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white text-3xl">delete</span>
                                    </div>

                                    <input type="checkbox"
                                           name="remove_photos[]"
                                           value="{{ $photo->id }}"
                                           id="remove-check-{{ $photo->id }}"
                                           class="hidden">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($existingCount < 6)
                        <div>
                            <label class="block text-xs text-slate-500 font-bold mb-2 text-right">
                                إضافة صور جديدة (الحد الأقصى: 6 في المجموع)
                            </label>
                            <input type="file"
                                   name="photos[]"
                                   multiple
                                   accept="image/*"
                                   id="new-photos-input"
                                   class="w-full text-sm text-slate-500
                                          file:ml-3 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-bold
                                          file:bg-[#10b981] file:text-white
                                          hover:file:opacity-90 cursor-pointer"/>

                            <p class="text-xs text-slate-400 mt-1 text-right" id="new-photos-hint">
                                يمكنك إضافة حتى {{ 6 - $existingCount }} صورة جديدة.
                            </p>
                        </div>
                    @else
                        <p class="text-xs text-amber-600 font-bold bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 text-right">
                            وصلت إلى الحد الأقصى (6 صور). احذف صورة لإضافة أخرى.
                        </p>
                    @endif
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-5 mt-5">
                    <button type="submit" class="px-8 py-2.5 bg-[#10b981] text-white rounded-md font-headline font-black text-sm hover:opacity-90 active:scale-95 transition-all shadow-sm">
                        {{ isset($initiative) ? 'حفظ التغييرات' : 'إضافة المبادرة' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function markRemove(photoId, btn) {
        const checkbox = document.getElementById('remove-check-' + photoId);
        const overlay = document.getElementById('remove-overlay-' + photoId);
        const wrapper = document.getElementById('photo-wrapper-' + photoId);
        const isMarked = checkbox.checked;

        if (isMarked) {
            checkbox.checked = false;
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            wrapper.classList.remove('ring-2', 'ring-red-500');
            btn.classList.remove('bg-green-500', 'hover:bg-green-600');
            btn.classList.add('bg-red-500', 'hover:bg-red-600');
            btn.querySelector('span').textContent = 'close';
        } else {
            checkbox.checked = true;
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            wrapper.classList.add('ring-2', 'ring-red-500');
            btn.classList.remove('bg-red-500', 'hover:bg-red-600');
            btn.classList.add('bg-green-500', 'hover:bg-green-600');
            btn.querySelector('span').textContent = 'undo';
        }
    }

    const input = document.getElementById('new-photos-input');
    if (input) {
        input.addEventListener('change', function () {
            const existingCount = document.querySelectorAll('[id^="photo-wrapper-"]').length;
            const removingCount = document.querySelectorAll('input[name="remove_photos[]"]:checked').length;
            const available = 6 - (existingCount - removingCount);

            if (this.files.length > available) {
                alert('يمكنك إضافة ' + available + ' صورة فقط.');
                this.value = '';
            }
        });
    }
</script>
@endsection