@extends('layouts.admin')
@section('title', 'مكتبة الصور')
@section('page-title', 'مكتبة الصور')

{{-- 1. حقن ملف الـ CSS في الـ Head --}}
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        /* تحسين شكل مؤشر الماوس عند تمريره فوق الصور */
        .photo-thumb {
            cursor: zoom-in;
        }
    </style>
@endpush

@section('content')
    <h2 class="font-headline text-xl font-black text-slate-900 mb-4">ألبوم الصور</h2>

    <div class="bg-surface-container-lowest rounded-md p-5">
        <p class="text-sm font-bold text-slate-700 mb-4">صور الأنشطة التي تم إنجازها</p>

        <div class="photo-grid">
            @forelse($photos as $photo)
                <div class="bg-white border border-slate-100 rounded-md overflow-hidden hover:shadow-md transition-all">

                    {{-- الرابط الذي يفتح الـ Lightbox (Album) --}}
                    <a href="{{ asset('storage/' . $photo->path) }}" data-fancybox="gallery"
                        data-caption="صورة رقم : {{ $photo->id }} - {{ $photo->created_at->format('Y-m-d') }}">

                        <div class="photo-thumb h-48 bg-slate-50 flex items-center justify-center overflow-hidden">
                            @if ($photo->path)
                                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover"
                                    alt="Photo {{ $photo->id }}" />
                            @else
                                <span class="material-symbols-outlined text-slate-300 text-4xl">image</span>
                            @endif
                        </div>
                    </a>

                    <div class="p-3">
                        {{-- رابط يوجه لتفاصيل النشاط عند الضغط على العنوان --}}
                        <a href="{{ route('admin.activities.show', $photo->idact) }}" class="group block text-right">
                            <p class="text-xs font-black text-slate-800 group-hover:text-emerald-600 transition-colors">
                                صورة رقم : {{ $photo->id }}
                            </p>
                            <p class="text-[11px] text-slate-400 mt-1">
                                {{ $photo->created_at->format('Y-m-d') }}
                            </p>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-sm">لا توجد صور حالياً في المكتبة.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $photos->links() }}
        </div>
    </div>
@endsection

{{-- 2. حقن ملف الـ JavaScript في أسفل الصفحة قبل إغلاق الـ Body --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox='gallery']", {
            // إعدادات العرض
            Carousel: {
                transition: "fade", // حركة ناعمة بين الصور
            },
            // إعدادات الشريط الجانبي (الصور المصغرة)
            Thumbs: {
                type: "classic", // يظهر الصور بشكل كلاسيكي في الجانب
            },
            // تخصيص شريط الأدوات العلوي
            Toolbar: {
                display: {
                    left: ["infobar"], // يظهر رقم الصورة (مثلاً 1/20) على اليسار
                    middle: [],
                    right: ["slideshow", "zoomIn", "zoomOut", "thumbs", "close"], // الأزرار التي طلبتها في اليمين
                },
            },
            // تعريب النصوص داخل الألبوم
            l10n: {
                NEXT: "التالي",
                PREV: "السابق",
                CLOSE: "إغلاق",
                ITERATE: "عرض تلقائي",
                ZOOM: "تكبير",
            }
        });
    </script>
@endpush
