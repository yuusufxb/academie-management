@extends('layouts.admin')
@section('title', 'البحث في الأنشطة')
@section('page-title', 'البحث في الأنشطة')
@section('content')
    <h2 class="font-headline text-xl font-black text-slate-900 mb-4">البحث في الأنشطة</h2>
    <form method="GET" action="{{ route('admin.search') }}"
        class="bg-surface-container-lowest rounded-md p-6 mb-6 space-y-4">
        <div class="grid grid-cols-3 gap-4">
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">العنوان</label><input name="title"
                    value="{{ request('title') }}" class="form-ctrl" placeholder="ابحث..." /></div>
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">النوع</label>
                <select name="type" class="form-ctrl">
                    <option value="">الكل</option>
                    @foreach (['احتفال', 'ورشة', 'مسابقة', 'رياضة', 'لقاء', 'دورة تكوينية', 'نشاط آخر'] as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">المسؤول</label><input
                    name="responsible" value="{{ request('responsible') }}" class="form-ctrl" placeholder="المسؤول..." />
            </div>
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">من تاريخ</label><input
                    name="from" type="date" value="{{ request('from') }}" class="form-ctrl" /></div>
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">إلى تاريخ</label><input
                    name="to" type="date" value="{{ request('to') }}" class="form-ctrl" /></div>
            <div><label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">المكان</label><input name="place"
                    value="{{ request('place') }}" class="form-ctrl" placeholder="المكان..." /></div>
        </div>
        <div class="flex gap-3 justify-end">
            <a href="{{ route('admin.search') }}"
                class="border border-outline-variant text-primary px-5 py-2.5 rounded-md font-bold text-sm">إعادة ضبط</a>
            <button type="submit"
                class="bg-primary text-white px-5 py-2.5 rounded-md font-bold text-sm active:scale-95">بحث</button>
        </div>
    </form>

    @if (request()->hasAny(['title', 'type', 'responsible', 'from', 'to', 'place']))
        <div class="bg-surface-container-lowest rounded-md overflow-hidden">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>رت</th>
                        <th>العنوان</th>
                        <th>النوع</th>
                        <th>التاريخ</th>
                        <th>المكان</th>
                        <th>المسؤول</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results ?? [] as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td class="font-bold">{{ $activity->title }}</td>
                            <td><span class="badge" style="background:#ccfbf1;color:#0f766e">{{ $activity->typ }}</span>
                            </td>
                            <td>{{ $activity->dte }}</td>
                            <td>{{ $activity->lieu }}</td>
                            <td>{{ $activity->resp }}</td>
                            <td>
                                <div class="flex gap-1">
                                    <a href="{{ route('admin.activities.show', $activity->id) }}" class="icon-action"
                                        style="background:#dbeafe;color:#1d4ed8"><span
                                            class="material-symbols-outlined text-sm">search</span></a>
                                    <a href="{{ route('admin.activities.edit', $activity->id) }}" class="icon-action"
                                        style="background:#fef3c7;color:#b45309"><span
                                            class="material-symbols-outlined text-sm">edit</span></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-400">لا توجد نتائج.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
@endsection
