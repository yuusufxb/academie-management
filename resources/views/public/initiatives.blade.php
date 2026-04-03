@extends('layouts.app')
@section('title', 'المبادرات الجهوية')
@section('content')
<div class="pt-16">
  <section class="bg-surface-container-low py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="mb-12">
        <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">المبادرات الجهوية المتميزة</span>
        <h2 class="font-headline text-primary text-3xl font-bold mt-2">المبادرات والأنشطة المتميزة جهوياً</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
          $initiatives = [
            ['id'=>1,'icon'=>'emoji_events','grad'=>'from-slate-800 to-emerald-900','tag'=>'محلي','tag_color'=>'bg-emerald-100 text-emerald-700','title'=>'م.م. ابن عباد بطل المسابقة الإقليمية','desc'=>'مدرسة ابن عباد تحقق بطولة الإقليم في إطار المسابقات الرياضية المدرسية الجهوية.'],
            ['id'=>2,'icon'=>'public','grad'=>'from-slate-700 to-slate-900','tag'=>'جهوي','tag_color'=>'bg-blue-100 text-blue-700','title'=>'م.م. ابن عباد تحتفل باليوم العالمي','desc'=>'احتفال تربوي شامل باليوم العالمي في إطار برامج التوعية البيئية والحقوقية.'],
            ['id'=>3,'icon'=>'child_care','grad'=>'from-emerald-800 to-slate-800','tag'=>'محلي','tag_color'=>'bg-emerald-100 text-emerald-700','title'=>'أطفال المستوى السادس في زيارة','desc'=>'زيارة تربوية ثقافية لأطفال المستوى السادس لاكتشاف مرافق جهوية ووطنية.'],
            ['id'=>4,'icon'=>'lightbulb','grad'=>'from-slate-800 to-emerald-800','tag'=>'محلي','tag_color'=>'bg-emerald-100 text-emerald-700','title'=>'معرض الأم المبدعة','desc'=>'معرض سنوي يحتفي بإبداعات الأمهات في إطار شراكة المدرسة والأسرة والمجتمع.'],
            ['id'=>5,'icon'=>'manage_accounts','grad'=>'from-slate-900 to-emerald-900','tag'=>'محلي','tag_color'=>'bg-emerald-100 text-emerald-700','title'=>'زيارة السيد المدير الإقليمي','desc'=>'زيارات ميدانية وإشرافية للمدير الإقليمي لمتابعة سير الأنشطة التربوية.'],
            ['id'=>6,'icon'=>'computer','grad'=>'from-slate-800 to-slate-700','tag'=>'جهوي','tag_color'=>'bg-blue-100 text-blue-700','title'=>'CODING POUR TOUS — برمجة للجميع','desc'=>'المديرية الإقليمية بتارودانت تنظم ورشات تكوينية حول البرمجة للجميع 2022-2026.'],
          ];
        @endphp
        @foreach($initiatives as $item)
         <a href="{{ route('initiatives.show', $item['id']) }}" class="block">
          <div class="bg-surface-container-lowest rounded-md overflow-hidden group cursor-pointer">
            <div class="h-48 bg-gradient-to-br {{ $item['grad'] }} flex items-center justify-center">
              <span class="material-symbols-outlined text-emerald-400 text-6xl">{{ $item['icon'] }}</span>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-on-surface-variant text-xs mb-3">
                <span class="{{ $item['tag_color'] }} text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $item['tag'] }}</span>
              </div>
              <h3 class="font-headline font-bold text-xl mb-3 group-hover:text-secondary transition-colors">{{ $item['title'] }}</h3>
              <p class="text-on-surface-variant text-sm line-clamp-3">{{ $item['desc'] }}</p>
            </div>
          </div>
         </a>
        @endforeach
      </div>
    </div>
  </section>
</div>
@endsection
