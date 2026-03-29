<!DOCTYPE html>
<html class="light" lang="ar" dir="rtl">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title', 'الأكاديمية الجهوية للتربية والتكوين — سوس ماسة')</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Public+Sans:wght@300;400;500;600&family=Inter:wght@400;500;600&family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode:"class",
  theme:{
    extend:{
      colors:{
        "primary-container":"#101b30","secondary-fixed-dim":"#59de9b","tertiary-container":"#001d36",
        "surface-container-high":"#e7e8e9","primary":"#000000","error-container":"#ffdad6",
        "on-tertiary-fixed-variant":"#2f4865","surface-container":"#edeeef","surface-container-low":"#f3f4f5",
        "on-tertiary-fixed":"#001d36","outline":"#74777d","on-background":"#191c1d",
        "on-tertiary-container":"#6d86a5","secondary-container":"#75f8b3","on-error":"#ffffff",
        "secondary-fixed":"#78fbb6","on-secondary-fixed":"#002111","tertiary":"#000000",
        "primary-fixed":"#d7e2ff","error":"#ba1a1a","on-primary-container":"#79849d",
        "secondary":"#006d43","on-surface":"#191c1d","inverse-surface":"#2e3132",
        "tertiary-fixed":"#d1e4ff","inverse-primary":"#bbc6e2","surface-container-lowest":"#ffffff",
        "tertiary-fixed-dim":"#afc9ea","background":"#f8f9fa","surface-container-highest":"#e1e3e4",
        "on-primary-fixed-variant":"#3c475d","on-secondary-container":"#007147",
        "inverse-on-surface":"#f0f1f2","on-tertiary":"#ffffff","on-error-container":"#93000a",
        "surface-variant":"#e1e3e4","surface-bright":"#f8f9fa","on-secondary-fixed-variant":"#005232",
        "on-secondary":"#ffffff","on-surface-variant":"#44474c","primary-fixed-dim":"#bbc6e2",
        "outline-variant":"#c4c6cc","surface-dim":"#d9dadb","surface":"#f8f9fa",
        "on-primary":"#ffffff","surface-tint":"#545e76","on-primary-fixed":"#101b30"
      },
      fontFamily:{
        "headline":["Tajawal","Manrope"],"body":["Tajawal","Public Sans"],"label":["Tajawal","Inter"]
      },
      borderRadius:{"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},
    },
  },
}
</script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
</head>
<body class="bg-surface font-body text-on-surface overflow-x-hidden">

@include('components.navbar')

<main>
  @yield('content')
</main>

@include('components.footer')

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
