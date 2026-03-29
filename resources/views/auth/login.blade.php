<!DOCTYPE html>
<html class="light" lang="ar" dir="rtl">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>تسجيل الدخول — الأكاديمية الجهوية</title>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .hero-gradient{background:linear-gradient(135deg,#000000 0%,#101b30 100%)}
  .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;vertical-align:middle}
</style>
</head>
<body>
<div class="min-h-screen hero-gradient flex">
  <!-- LEFT PANEL -->
  <div class="flex-1 flex flex-col justify-center px-16 py-12 text-white max-w-xl">
    <div class="flex items-center gap-3 mb-12">
      <div class="w-11 h-11 bg-emerald-500 rounded-xl flex items-center justify-center"><span class="font-black text-xl text-white" style="font-family:Tajawal">أ</span></div>
      <div>
        <strong class="block text-base font-black" style="font-family:Tajawal">الأكاديمية الجهوية للتربية والتكوين</strong>
        <span class="text-xs text-white/40" style="font-family:Tajawal">جهة سوس ماسة — منصة الأنشطة المدرسية</span>
      </div>
    </div>
    <div class="w-full max-w-sm h-64 rounded-xl bg-white/10 border border-white/10 flex items-center justify-center mb-8 overflow-hidden">
      <div class="text-center p-8">
        <span class="material-symbols-outlined text-6xl text-emerald-400 mb-4 block">account_balance</span>
        <p class="font-black text-lg mb-2" style="font-family:Tajawal">الأكاديمية الجهوية للتربية والتكوين</p>
        <p class="text-white/50 text-sm" style="font-family:Tajawal">جهة سوس ماسة — شكراً على تفاعلكم مع المنصة</p>
      </div>
    </div>
    <div class="space-y-4">
      <div class="flex items-start gap-3"><div class="bg-white/10 p-2 rounded-lg"><span class="material-symbols-outlined text-emerald-400">dashboard</span></div><div><p class="font-bold text-sm" style="font-family:Tajawal">لوحة قيادة متكاملة</p><p class="text-white/40 text-xs" style="font-family:Tajawal">تتبع جميع الأنشطة والإحصاءات في الوقت الفعلي</p></div></div>
      <div class="flex items-start gap-3"><div class="bg-white/10 p-2 rounded-lg"><span class="material-symbols-outlined text-emerald-400">verified_user</span></div><div><p class="font-bold text-sm" style="font-family:Tajawal">نظام مصادقة متعدد المستويات</p><p class="text-white/40 text-xs" style="font-family:Tajawal">مسار تحقق من المؤسسة إلى الأكاديمية</p></div></div>
      <div class="flex items-start gap-3"><div class="bg-white/10 p-2 rounded-lg"><span class="material-symbols-outlined text-emerald-400">file_download</span></div><div><p class="font-bold text-sm" style="font-family:Tajawal">تقارير وتصدير</p><p class="text-white/40 text-xs" style="font-family:Tajawal">PDF وExcel لكل مستوى هرمي</p></div></div>
    </div>
  </div>

  <!-- RIGHT FORM PANEL -->
  <div class="w-[420px] flex-shrink-0 bg-white flex flex-col justify-center px-10 py-12">
    <h2 class="text-2xl font-black text-slate-900 mb-2" style="font-family:Tajawal">الولوج إلى المنصة</h2>
    <p class="text-slate-500 text-sm mb-8" style="font-family:Tajawal">أدخل بيانات حسابك للوصول إلى لوحة التتبع</p>

    <!-- ROLE SELECTOR -->
    <div class="flex gap-1 p-1 bg-slate-100 rounded-lg mb-6" id="roleBar">
      <button type="button" onclick="selRole(this,'مؤسسة')" class="flex-1 py-2 rounded-md bg-white shadow-sm text-sm font-bold text-slate-800 transition-all" style="font-family:Tajawal">مؤسسة</button>
      <button type="button" onclick="selRole(this,'إقليم')" class="flex-1 py-2 rounded-md text-sm font-medium text-slate-500 hover:bg-white/60 transition-all" style="font-family:Tajawal">إقليم</button>
      <button type="button" onclick="selRole(this,'أكاديمية')" class="flex-1 py-2 rounded-md text-sm font-medium text-slate-500 hover:bg-white/60 transition-all" style="font-family:Tajawal">أكاديمية</button>
    </div>

    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md mb-4 text-sm" style="font-family:Tajawal">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4 mb-6">
      @csrf
      <input type="hidden" name="role" id="roleInput" value="مؤسسة"/>
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2" style="font-family:Tajawal">اسم المستخدم</label>
        <input type="text" name="username" placeholder="اسم المستخدم" class="w-full bg-slate-50 border border-slate-200 rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-right" style="font-family:Tajawal"/>
      </div>
      <div>
        <label class="block text-xs font-bold text-slate-500 uppercase mb-2" style="font-family:Tajawal">القن السري</label>
        <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-md px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all text-right"/>
      </div>
      <div class="flex items-center gap-2">
        <input type="checkbox" name="remember" id="rem" class="accent-emerald-600"/>
        <label for="rem" class="text-sm text-slate-500 cursor-pointer" style="font-family:Tajawal">تذكرني</label>
      </div>
      <button type="submit" class="w-full bg-black text-white py-3.5 rounded-md font-black text-base hover:shadow-lg active:scale-95 transition-all" style="font-family:Tajawal">تسجيل الدخول</button>
    </form>

    <p class="text-center text-xs text-slate-400" style="font-family:Tajawal">
      العودة إلى الموقع: <a href="{{ route('home') }}" class="text-emerald-600 font-bold hover:underline">الرئيسية</a>
    </p>
    <p class="text-center text-[10px] text-slate-300 mt-8" style="font-family:Tajawal">تصميم المركز الجهوي لمنظومة الإعلام — الأكاديمية الجهوية للتربية والتكوين لجهة سوس ماسة</p>
  </div>
</div>
<script>
function selRole(btn, role) {
  document.querySelectorAll('#roleBar button').forEach(b => {
    b.className = 'flex-1 py-2 rounded-md text-sm font-medium text-slate-500 hover:bg-white/60 transition-all';
    b.style.fontFamily = 'Tajawal';
  });
  btn.className = 'flex-1 py-2 rounded-md bg-white shadow-sm text-sm font-bold text-slate-800 transition-all';
  document.getElementById('roleInput').value = role;
}
</script>
</body>
</html>
