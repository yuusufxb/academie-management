@extends('layouts.app')
@section('title', 'تواصل معنا')
@section('content')
<div class="pt-16">
  <section class="py-24 px-6 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16">
    <div>
      <span class="text-secondary font-label font-bold tracking-widest uppercase text-xs">تواصل معنا</span>
      <h2 class="font-headline text-primary text-4xl font-bold mt-2 mb-8">للمزيد من المعلومات راسلنا</h2>
      <p class="text-on-surface-variant text-lg mb-12">للتواصل مع فريق الأكاديمية أو الإبلاغ عن أي مشكل تقني. نحن هنا للمساعدة خلال أوقات العمل الرسمية.</p>
      <div class="space-y-8">
        <div class="flex items-start gap-4">
          <div class="bg-secondary/10 p-3 rounded-md text-secondary"><span class="material-symbols-outlined">location_on</span></div>
          <div><p class="font-headline font-bold text-slate-900">المقر الرئيسي</p><p class="text-on-surface-variant text-sm">أكادير 80000، جهة سوس ماسة، المملكة المغربية</p></div>
        </div>
        <div class="flex items-start gap-4">
          <div class="bg-secondary/10 p-3 rounded-md text-secondary"><span class="material-symbols-outlined">phone</span></div>
          <div><p class="font-headline font-bold text-slate-900">اتصل بنا</p><p class="text-on-surface-variant text-sm">+212 528 XX XX XX</p></div>
        </div>
        <div class="flex items-start gap-4">
          <div class="bg-secondary/10 p-3 rounded-md text-secondary"><span class="material-symbols-outlined">language</span></div>
          <div><p class="font-headline font-bold text-slate-900">الموقع الرسمي</p><p class="text-on-surface-variant text-sm">www.aref-souss-massa.ma</p></div>
        </div>
      </div>
      <div class="h-52 rounded-xl overflow-hidden shadow-sm bg-surface-container mt-8 flex items-center justify-center">
        <span class="material-symbols-outlined text-6xl text-slate-400">map</span>
      </div>
    </div>
    <div class="bg-surface-container-low p-10 rounded-xl">
      <h3 class="font-headline font-bold text-2xl mb-8">إرسال رسالة</h3>
      @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md mb-6 text-sm font-bold">تم إرسال رسالتك بنجاح!</div>
      @endif
      <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الاسم الكامل</label>
            <input name="name" class="w-full bg-white border-none rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body" placeholder="الاسم..."/>
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">البريد الإلكتروني</label>
            <input name="email" class="w-full bg-white border-none rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body" type="email" placeholder="exemple@email.com"/>
          </div>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الموضوع</label>
          <select name="subject" class="w-full bg-white border-none rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body">
            <option>استفسار عام</option><option>طلب وثائق المجلس</option><option>شراكة</option><option>دعم تقني</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-bold text-slate-500 uppercase mb-2">نص الرسالة</label>
          <textarea name="message" class="w-full bg-white border-none rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-secondary/20 transition-all text-right font-body" placeholder="اكتب رسالتك بالتفصيل..." rows="6"></textarea>
        </div>
        <div class="flex items-center justify-between">
          <p class="text-xs text-slate-400">سأجيب في أقرب وقت ممكن</p>
          <button type="submit" class="bg-primary text-white py-3 px-8 rounded-md font-headline font-bold text-base hover:shadow-lg active:scale-95 transition-all">إرسال</button>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection
