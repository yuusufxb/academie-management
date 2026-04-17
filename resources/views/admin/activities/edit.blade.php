@extends('layouts.admin')
@section('title', 'تعديل النشاط')
@section('page-title', 'تتبع الأنشطة')

@section('content')

<div class="flex items-center justify-between mb-5">
  <h2 class="font-headline text-xl font-black text-slate-900">تعديل النشاط</h2>
  <a href="{{ route('admin.activities.index') }}"
     class="flex items-center gap-1 text-slate-500 hover:text-slate-800 text-sm font-bold transition-colors">
    <span class="material-symbols-outlined text-base">arrow_forward</span>رجوع
  </a>
</div>

@if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm font-bold text-right mb-4">
    {{ session('success') }}
  </div>
@endif

@if($errors->any())
  <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md text-sm font-bold text-right mb-4">
    <ul class="list-disc list-inside space-y-1">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="max-w-2xl font-headline" dir="rtl">
  <form method="POST"
        action="{{ route('admin.activities.update', $activity->id) }}"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-5">

      {{-- نوع النشاط --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">نوع النشاط</label>
        <select name="typ" class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none">
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (old('typ', $activity->typ) == $cat->id) ? 'selected' : '' }}>
              {{ $cat->caty }}
            </option>
          @endforeach
        </select>
        @error('typ') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- تاريخ النشاط --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">تاريخ النشاط</label>
          <input name="dte" type="date"
                 value="{{ old('dte', $activity->dte) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('dte') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- الوقت --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">على الساعة</label>
          <input name="hr" type="time"
                 value="{{ old('hr', $activity->hr) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('hr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      {{-- عنوان النشاط --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">عنوان النشاط</label>
        <textarea name="title"
                  class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"
                  style="height:80px">{{ old('title', $activity->title) }}</textarea>
        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- المسؤول --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المسؤول عن النشاط</label>
          <input name="resp" type="text"
                 value="{{ old('resp', $activity->resp) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('resp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- المكان --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">مكان النشاط</label>
          <input name="lieu" type="text"
                 value="{{ old('lieu', $activity->lieu) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('lieu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        {{-- المستفيدون --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المستفيدون</label>
          <input name="benfs" type="text"
                 value="{{ old('benfs', $activity->benfs) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('benfs') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        {{-- عددهم --}}
        <div>
          <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">عددهم</label>
          <input name="nb" type="number"
                 value="{{ old('nb', $activity->nb) }}"
                 class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
          @error('nb') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      {{-- المرجع --}}
      <div>
        <label class="block text-[#0f2b26] text-sm font-black mb-2 text-right">المرجع</label>
        <input name="ref" type="text"
               value="{{ old('ref', $activity->ref) }}"
               class="form-ctrl w-full border border-slate-200 rounded-lg p-2 text-sm bg-slate-50 focus:bg-white focus:border-[#10b981] outline-none"/>
        @error('ref') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      {{-- ===== قسم الصور ===== --}}
      <div class="border-t border-slate-100 pt-5">
        <div class="flex items-center justify-between mb-3">
          <label class="block text-[#0f2b26] text-sm font-black text-right">
            صور النشاط
          </label>
          <span class="text-xs text-slate-400" id="photo-counter">
            {{ $activity->photos->count() }} / 6 صور
          </span>
        </div>

        {{-- الصور الحالية --}}
        @if($activity->photos->count() > 0)
          <div class="grid grid-cols-3 gap-3 mb-4" id="existing-photos">
            @foreach($activity->photos as $photo)
              <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-50"
                   id="photo-wrapper-{{ $photo->id }}">
                <img src="{{ photo_asset($photo->path) }}"
                     alt="{{ $photo->name }}"
                     class="w-full h-28 object-cover">

                {{-- زر الحذف --}}
                <button type="button"
                        onclick="markRemove({{ $photo->id }}, this)"
                        class="absolute top-1 left-1 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow transition-all opacity-0 group-hover:opacity-100">
                  <span class="material-symbols-outlined text-sm">close</span>
                </button>

                {{-- طبقة "محدد للحذف" --}}
                <div id="remove-overlay-{{ $photo->id }}"
                     class="hidden absolute inset-0 bg-red-500/60 flex items-center justify-center">
                  <span class="material-symbols-outlined text-white text-3xl">delete</span>
                </div>

                {{-- input مخفي يُرسَل عند الحذف --}}
                <input type="checkbox"
                       name="remove_photos[]"
                       value="{{ $photo->id }}"
                       id="remove-check-{{ $photo->id }}"
                       class="hidden">
              </div>
            @endforeach
          </div>
        @else
          <p class="text-slate-400 text-xs text-right mb-3">لا توجد صور مضافة.</p>
        @endif

        {{-- إضافة صور جديدة --}}
        @if($activity->photos->count() < 6)
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
              يمكنك إضافة حتى {{ 6 - $activity->photos->count() }} صورة جديدة.
            </p>
          </div>
        @else
          <p class="text-xs text-amber-600 font-bold bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 text-right">
            ⚠ وصلت إلى الحد الأقصى (6 صور). احذف صورة لإضافة أخرى.
          </p>
        @endif
      </div>

      {{-- زر الحفظ --}}
      <div class="flex justify-end pt-4 border-t border-slate-100">
        <a href="{{ route('admin.activities.index') }}"
           class="ml-3 px-5 py-2.5 border border-slate-200 text-slate-600 rounded-lg font-bold text-sm hover:bg-slate-50 transition-all">
          إلغاء
        </a>
        <button type="submit"
                class="px-6 py-2.5 bg-[#10b981] text-white rounded-lg font-bold text-sm hover:opacity-90 active:scale-95 transition-all">
          حفظ التغييرات
        </button>
      </div>

    </div>
  </form>
</div>

<script>
  // When user clicks the X on an existing photo
  function markRemove(photoId, btn) {
    const checkbox = document.getElementById('remove-check-' + photoId);
    const overlay  = document.getElementById('remove-overlay-' + photoId);
    const wrapper  = document.getElementById('photo-wrapper-' + photoId);
    const isMarked = checkbox.checked;

    if (isMarked) {
      // Unmark
      checkbox.checked = false;
      overlay.classList.add('hidden');
      overlay.classList.remove('flex');
      wrapper.classList.remove('ring-2', 'ring-red-500');
      btn.classList.remove('bg-green-500', 'hover:bg-green-600');
      btn.classList.add('bg-red-500', 'hover:bg-red-600');
      btn.querySelector('span').textContent = 'close';
    } else {
      // Mark for removal
      checkbox.checked = true;
      overlay.classList.remove('hidden');
      overlay.classList.add('flex');
      wrapper.classList.add('ring-2', 'ring-red-500');
      btn.classList.remove('bg-red-500', 'hover:bg-red-600');
      btn.classList.add('bg-green-500', 'hover:bg-green-600');
      btn.querySelector('span').textContent = 'undo';
    }
  }

  // Limit new file uploads based on existing + marked-for-removal
  const input = document.getElementById('new-photos-input');
  if (input) {
    input.addEventListener('change', function () {
      const existingCount  = document.querySelectorAll('[id^="photo-wrapper-"]').length;
      const removingCount  = document.querySelectorAll('input[name="remove_photos[]"]:checked').length;
      const available      = 6 - (existingCount - removingCount);

      if (this.files.length > available) {
        alert('يمكنك إضافة ' + available + ' صورة فقط.');
        this.value = '';
      }
    });
  }
</script>

@endsection