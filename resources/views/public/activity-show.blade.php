@extends('layouts.app')
@section('title', $activity->title ?? 'تفاصيل النشاط')

@section('content')
<div class="pt-16 font-sans" style="background:#f8fafc; min-height:100vh" dir="rtl">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- Entire page description as a single large card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Right-Aligned Header Banner --}}
            <div class="p-8 border-b border-slate-100 text-right"
                 style="background-color: #0f2b26; background-image: linear-gradient(to right, #0f2b26 0%, #12312b 100%);">
                <h1 class="font-headline font-black text-2xl lg:text-3xl text-white leading-tight">
                    {{ $activity->title }}
                </h1>
            </div>

            <div class="space-y-0 divider-slate-100">

                {{-- Activity Details Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تفاصيل النشاط</h3>
                    </div>

                    <div class="grid grid-cols-2 divide-x divide-x-reverse divide-[#10b981]/10 border border-slate-100 rounded-2xl overflow-hidden hover:border-[#10b981]/20 transition-all">
                        {{-- Cell 1: Title --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">عنوان النشاط</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->title }}</p>
                        </div>
                        {{-- Cell 2: Date --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">تاريخ النشاط</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->dte }}</p>
                        </div>
                        {{-- Cell 3: Beneficiaries --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">المستفيدون</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->benfs ?? 'تلاميذ وتلميذات المؤسسة' }}</p>
                        </div>
                        {{-- Cell 4: Count --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">عددهم</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->nb ?? '---' }}</p>
                        </div>
                        {{-- Cell 5: Place --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">مكان النشاط</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->lieu }}</p>
                        </div>
                        {{-- Cell 6: Responsible --}}
                        <div class="px-6 py-5 border-b border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">المسؤول عن النشاط</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->resp }}</p>
                        </div>
                        {{-- Cell 7: Reference --}}
                        <div class="px-6 py-5 border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">مرجع النشاط</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">---</p>
                        </div>
                        {{-- Cell 8: Created At --}}
                        <div class="px-6 py-5 border-slate-100 text-right hover:bg-slate-50 transition-colors">
                            <p class="text-slate-400 text-xs mb-1.5">تاريخ الإضافة</p>
                            <p class="text-[#0f2b26] text-sm font-bold leading-relaxed">{{ $activity->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Report Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">تقرير النشاط</h3>
                    </div>
                    <p class="text-slate-600 text-base leading-loose text-justify px-2">
                        @if($activity->reports->isNotEmpty())
                            {{ $activity->reports->first()->rap }}
                        @else
                            لا يوجد تقرير مفصل لهذا النشاط حالياً.
                        @endif
                    </p>
                </div>

                {{-- Photos Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">صور النشاط</h3>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 px-2">
                        @forelse($activity->photos as $photo)
                            <div class="rounded-2xl overflow-hidden aspect-square bg-slate-100 border border-slate-200 group cursor-pointer shadow-sm hover:shadow-md transition-shadow">
                                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" alt="Activity Photo"/>
                            </div>
                        @empty
                            @foreach(range(1,4) as $i)
                            <div class="rounded-2xl bg-slate-50 border border-slate-100 aspect-square flex items-center justify-center hover:border-[#10b981]/20 transition-all">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            @endforeach
                        @endforelse
                    </div>
                </div>

                {{-- Inspection Section --}}
                <div class="p-8 border-b border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-6 rounded-full bg-gradient-to-b from-[#10b981] to-[#10b981]/70"></div>
                        <h3 class="font-headline font-black text-lg text-[#0f2b26]">معاينة</h3>
                    </div>
                    <div class="px-2">
                        @php $mainPhoto = $activity->mainPhoto ?? $activity->photos->first(); @endphp
                        @if($mainPhoto)
                            <div class="rounded-2xl overflow-hidden border-2 border-slate-100 group shadow-lg hover:border-[#10b981]/40 transition-all">
                                <img src="{{ asset('storage/'.$mainPhoto->path) }}" class="w-full object-cover transition-all group-hover:scale-[1.01]"/>
                            </div>
                        @else
                            <div class="w-full h-56 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center hover:border-[#10b981]/20 transition-all">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Footer credit section --}}
                <div class="p-8 text-center bg-slate-50 border-t border-slate-100">
                    <p class="text-[#0f2b26] text-sm font-bold mb-1.5">مصلحة التواصل وتتبع أشغال المجلس الإداري</p>
                    <p class="text-[#10b981] text-xs font-semibold tracking-wide">الأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection