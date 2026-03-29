@extends('layouts.admin')
@section('title', 'برمجة النشاط')
@section('page-title', 'برمجة النشاط')

@section('content')

<div class="av" id="av-schedule">
  <h2 class="font-headline text-xl font-black text-slate-900 mb-4">برمجة النشاط</h2>

  <form method="POST"
        action="{{ route('admin.activities.schedule.store') }}"
        class="bg-surface-container-lowest rounded-md p-6">

    @csrf

    {{-- ERRORS --}}
    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md text-sm mb-4">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="grid grid-cols-2 gap-4 mb-4">

      {{-- المسؤول (select كما هو) --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">المسؤول عن النشاط</label>
        <select name="responsible" class="form-ctrl">
          <option value="منظومة الإعلام" {{ old('responsible') == 'منظومة الإعلام' ? 'selected' : '' }}>
            منظومة الإعلام
          </option>
        </select>
      </div>

      {{-- اسم النشاط --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">اسم النشاط</label>
        <input name="name" class="form-ctrl" type="text"
               value="{{ old('name') }}"
               placeholder="اسم النشاط"/>
      </div>

      {{-- نوع النشاط --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">نوع النشاط</label>
        <input name="type" class="form-ctrl" type="text"
               value="{{ old('type') }}"
               placeholder="نشاط آخر"/>
      </div>

      {{-- الجهة المسؤولة --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الجهة المسؤولة</label>
        <input name="organization" class="form-ctrl" type="text"
               value="{{ old('organization') }}"/>
      </div>

    </div>

    {{-- النتائج --}}
    <div class="mb-4">
      <label class="block text-xs font-bold text-slate-500 uppercase mb-2">النتائج المنتظرة من النشاط</label>
      <textarea name="expected_results" class="form-ctrl">{{ old('expected_results') }}</textarea>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-4">

      {{-- عدد المشاركين --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">المشاركون (عدد)</label>
        <input name="participants_count" class="form-ctrl" type="number"
               value="{{ old('participants_count', 0) }}"/>
      </div>

      {{-- التاريخ --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">تاريخ انجاز النشاط</label>
        <input name="scheduled_date" class="form-ctrl" type="date"
               value="{{ old('scheduled_date') }}"/>
      </div>

      {{-- المكان --}}
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">مكان انجاز النشاط</label>
        <input name="place" class="form-ctrl" type="text"
               value="{{ old('place') }}"/>
      </div>

    </div>

    {{-- تفاصيل المشاركين --}}
    <div class="mb-4">
      <label class="block text-xs font-bold text-slate-500 uppercase mb-2">المشاركون (تفاصيل)</label>
      <textarea name="participants_details" class="form-ctrl">{{ old('participants_details') }}</textarea>
    </div>

    {{-- وصف --}}
    <div class="mb-6">
      <label class="block text-xs font-bold text-slate-500 uppercase mb-2">وصف مركز للنشاط</label>
      <textarea name="description" class="form-ctrl">{{ old('description') }}</textarea>
    </div>

    {{-- buttons (same design) --}}
    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
      <a href="{{ route('admin.activities.programmed') }}"
         class="border border-outline-variant text-primary px-6 py-2.5 rounded-md font-bold text-sm">
        إلغاء
      </a>

      <button type="submit"
              class="bg-secondary text-white px-6 py-2.5 rounded-md font-bold text-sm hover:shadow-md active:scale-95">
        حفظ المعلومات
      </button>
    </div>

  </form>
</div>

@endsection