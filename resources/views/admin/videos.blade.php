@extends('layouts.admin')
@section('title', 'مكتبة الفيديو')
@section('page-title', 'مكتبة الفيديو')
@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-headline text-xl font-black text-slate-900">تتبع الفيديو</h2>
        <a href="{{ route('admin.videos.create') }}"
            class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة فيديو جديد</a>
    </div>

    <div class="bg-surface-container-lowest rounded-md overflow-hidden">
        <table class="data-table w-full text-right">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="py-4 px-4 text-slate-500 font-bold text-sm">رت</th>
                    <th class="py-4 px-4 text-slate-500 font-bold text-sm">النظام</th>
                    <th class="py-4 px-4 text-slate-500 font-bold text-sm">العنوان</th>
                    <th class="py-4 px-4 text-slate-500 font-bold text-sm">تاريخ الإضافة</th>
                    <th class="py-4 px-4 text-slate-500 font-bold text-sm text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos ?? [] as $video)
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-4 text-slate-400 text-sm">{{ $video->id }}</td>

                        <td class="py-4 px-4">
                            @php
                                // منطق تحديد اللون بناءً على نوع المنصة (typ)
                                $isYoutube =
                                    Str::contains(strtolower($video->typ), 'youtube') ||
                                    Str::contains(strtolower($video->link), 'youtube');
                                $isFacebook =
                                    Str::contains(strtolower($video->typ), 'facebook') ||
                                    Str::contains(strtolower($video->link), 'facebook');
                            @endphp

                            @if($video->typ == 1)
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                    style="background:#fee2e2; color:#b91c1c">YouTube</span>
                            @elseif($video->typ == 2)
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                    style="background:#dbeafe; color:#1d4ed8">FaceBook</span>
                            @else
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">{{ $video->typ }}</span>
                            @endif
                        </td>

                        <td class="py-4 px-4 font-bold text-slate-900 text-sm">
                            {{ Str::limit($video->title, 50) }}
                        </td>

                        <td class="py-4 px-4 text-slate-500 text-sm">
                            {{ $video->created_at->format('Y-m-d') }}
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex gap-1 justify-center">
                                {{-- 1. زر البحث (الأزرق) --}}
                                <a href="{{ route('admin.videos.show', $video->id) }}" class="icon-action"
                                    style="background:#dbeafe;color:#1d4ed8">
                                    <span class="material-symbols-outlined text-sm">search</span>
                                </a>

                                {{-- 2. زر التعديل (الأصفر) --}}
                                <a href="{{ route('admin.videos.edit', $video->id) }}" class="icon-action"
                                    style="background:#fef3c7;color:#b45309">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>

                                {{-- 3. زر الحذف (الأحمر) --}}
                                <form method="POST" action="{{ route('admin.videos.destroy', $video->id) }}"
                                    onsubmit="return confirm('هل أنت متأكد؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="icon-action" style="background:#fee2e2;color:#b91c1c">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-20 text-slate-400 italic">لا توجد فيديوهات مضافة حالياً.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($videos->hasPages())
        <div class="mt-6">
            {{ $videos->links() }}
        </div>
    @endif
@endsection
