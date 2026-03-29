@extends('layouts.admin')
@section('title', 'صندوق الرسائل')
@section('page-title', 'صندوق الرسائل')

@section('content')
<h2 class="font-headline text-xl font-black text-slate-900 mb-4">تتبع الرسائل الواردة</h2>
<div class="bg-surface-container-lowest rounded-md p-5">
  <p class="font-headline font-black text-lg text-slate-900 mb-4">3 رسالة جديدة من أصل (7)</p>
  <div class="divide-y divide-slate-50">
    @php
      $messages = [
        ['name'=>'مدير مدرسة اكيدار الجديدة','subject'=>'طلب كيفية ادخال الصور للانشطة','status'=>'مسجل','status_class'=>'bg-slate-200 text-slate-600','bg'=>'bg-amber-50/50','date'=>'2024-10-07','attach'=>true],
        ['name'=>'مدير مدرسة اكيدار الجديدة','subject'=>'كيفية اضافة صور الانشطة','status'=>'جديد','status_class'=>'bg-red-100 text-red-600','bg'=>'bg-red-50/50','date'=>'2024-06-09','attach'=>true],
        ['name'=>'محمد','subject'=>'كرابيزم','status'=>'جديد','status_class'=>'bg-red-100 text-red-600','bg'=>'bg-red-50/50','date'=>'2024-06-09','attach'=>false],
        ['name'=>'حسن الديب مدير تيزنيت','subject'=>'صعوبة الولوج الى منصة انشطتي','status'=>'جديد','status_class'=>'bg-red-100 text-red-600','bg'=>'bg-red-50/50','date'=>'2024-06-01','attach'=>true],
      ];
    @endphp
    @foreach($messages as $i => $msg)
      <div class="flex items-start gap-3 py-3 hover:bg-slate-50 rounded-md px-2 cursor-pointer {{ $msg['bg'] }}">
        <span class="text-amber-400">⭐</span>
        <div class="flex-1">
          <p class="text-sm font-bold text-slate-800">{{ $i+1 }}. {{ $msg['name'] }}</p>
          <p class="text-xs text-slate-600 mt-0.5">
            {{ $msg['subject'] }} —
            <span class="text-[10px] {{ $msg['status_class'] }} px-1.5 py-0.5 rounded-full font-bold">{{ $msg['status'] }}</span>
          </p>
          <p class="text-[11px] text-slate-400 mt-1">{{ $msg['attach'] ? '📎 ' : '' }}{{ $msg['date'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
