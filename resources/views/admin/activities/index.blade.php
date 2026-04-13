@extends('layouts.admin')
@section('title', 'لائحة الأنشطة')
@section('page-title', 'لائحة الأنشطة')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="font-headline text-xl font-black text-slate-900">لائحة الأنشطة</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.activities.create') }}"
                class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">+ إضافة نشاط</a>
            <button class="border border-outline-variant text-primary px-4 py-2 rounded-md text-sm font-bold">تصدير
                (.xlsx)</button>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.activities.index') }}"
        class="bg-surface-container-lowest rounded-md p-4 mb-4 flex gap-3">
        <input name="q" value="{{ request('q') }}" placeholder="بحث في الأنشطة..."
            class="flex-1 bg-slate-50 border border-slate-200 rounded-md px-4 py-2.5 text-sm text-right font-body" />

        <select name="typ"
            class="bg-slate-50 border border-slate-200 rounded-md px-4 py-2.5 text-sm font-body text-right">
            <option value="">كل الأنواع</option>
            @foreach ($categories as $category)
                {{-- المقارنة باستعمال == تحل مشكلة تحول الاختيار بعد البحث --}}
                <option value="{{ $category->id }}" {{ request('typ') == $category->id ? 'selected' : '' }}>
                    {{ $category->caty }}
                </option>
            @endforeach
        </select>

        <button type="submit"
            class="bg-primary text-white px-5 py-2.5 rounded-md text-sm font-bold active:scale-95">بحث</button>
    </form>

    <div class="bg-surface-container-lowest rounded-md overflow-hidden">

        @php
            // مصفوفة الألوان لتوزيعها على الأسطر كما في التصميم الأصلي
            $badgeColors = [
                ['bg' => '#ccfbf1', 'text' => '#0f766e'],
                ['bg' => '#ede9fe', 'text' => '#6d28d9'],
                ['bg' => '#fef3c7', 'text' => '#b45309'],
                ['bg' => '#fee2e2', 'text' => '#b91c1c'],
                ['bg' => '#dcfce7', 'text' => '#166534'],
            ];
            $respColors = [
                ['bg' => '#dbeafe', 'text' => '#1d4ed8'],
                ['bg' => '#dcfce7', 'text' => '#166534'],
                ['bg' => '#f1f5f9', 'text' => '#64748b'],
            ];

            // نفس المصفوفة لتحويل الأرقام إلى نصوص
            $typeNames = [
                1 => 'احتفال',
                2 => 'ورشة',
                3 => 'نشاط آخر',
                4 => 'لقاء',
                5 => 'مسابقة',
                6 => 'رياضة',
                7 => 'دورة تكوينية',
            ];
        @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th>رت</th>
                    <th>عنوانه</th>
                    <th>نوع النشاط</th>
                    <th>تاريخه</th>
                    <th>مكانه</th>
                    <th>المسؤول</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $index => $activity)
                    @php
                        $bColor = $badgeColors[$index % count($badgeColors)];
                        $rColor = $respColors[$index % count($respColors)];
                        $activityTypeName = $typeNames[$activity->typ] ?? $activity->typ;
                    @endphp
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td class="font-bold"
                            style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                            {{ $activity->title }}</td>

                        {{-- تعديل حقل النوع مع الألوان الديناميكية --}}
                        <td><span class="badge"
                                style="background:{{ $bColor['bg'] }};color:{{ $bColor['text'] }}">{{ $activityTypeName }}</span>
                        </td>

                        {{-- تعديل date إلى dte --}}
                        <td>{{ $activity->dte }}</td>

                        {{-- تعديل place إلى lieu --}}
                        <td>{{ $activity->lieu }}</td>

                        {{-- تعديل responsible إلى resp مع الألوان --}}
                        <td><span class="badge"
                                style="background:{{ $rColor['bg'] }};color:{{ $rColor['text'] }};font-size:10px">{{ $activity->resp }}</span>
                        </td>

                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.activities.show', $activity->id) }}" class="icon-action"
                                    style="background:#dbeafe;color:#1d4ed8"><span
                                        class="material-symbols-outlined text-sm">search</span></a>
                                <a href="{{ route('admin.activities.edit', $activity->id) }}" class="icon-action"
                                    style="background:#fef3c7;color:#b45309"><span
                                        class="material-symbols-outlined text-sm">edit</span></a>
                                <form method="POST" action="{{ route('admin.activities.destroy', $activity->id) }}"
                                    onsubmit="return confirm('هل أنت متأكد؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="icon-action"
                                        style="background:#fee2e2;color:#b91c1c"><span
                                            class="material-symbols-outlined text-sm">delete</span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-slate-400">لا توجد أنشطة.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $activities->withQueryString()->links() }}</div>
    </div>
@endsection
