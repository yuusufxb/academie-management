<aside class="fixed right-0 top-14 bottom-0 w-[230px] bg-white border-l border-slate-100 overflow-y-auto z-40 flex flex-col py-3">
  @php $user = auth()->user(); @endphp

  <span class="sidebar-label">الرئيسية</span>
  <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">dashboard</span>لوحة التتبع
  </a>
  <a href="{{ route('admin.search') }}" class="sidebar-link {{ request()->routeIs('admin.search') ? 'active' : '' }}">
    <span class="material-symbols-outlined text-base">search</span>البحث
  </a>

  <span class="sidebar-label mt-2">الأنشطة</span>
  <a href="{{ route('admin.activities.index') }}" class="sidebar-link {{ request()->routeIs('admin.activities.index') ? 'active' : '' }}">
    <span class="material-symbols-outlined text-base">format_list_bulleted</span>لائحة الأنشطة
  </a>
  
  @if($user && $user->canManageActivities())
    <a href="{{ route('admin.activities.create') }}" class="sidebar-link {{ request()->routeIs('admin.activities.create') ? 'active' : '' }}">
      <span class="material-symbols-outlined text-base">add_circle</span>إضافة نشاط جديد
    </a>
  @endif

  @if($user && $user->hasAnyLevel(2, 3, 5, 6))
    <div class="border-t border-slate-100 my-2 mx-3"></div>
    <span class="sidebar-label">المحتوى</span>
    <a href="{{ route('admin.photos') }}" class="sidebar-link {{ request()->routeIs('admin.photos') ? 'active' : '' }}">
      <span class="material-symbols-outlined text-base">photo_library</span>مكتبة الصور
    </a>
    <a href="{{ route('admin.videos') }}" class="sidebar-link {{ request()->routeIs('admin.videos') ? 'active' : '' }}">
      <span class="material-symbols-outlined text-base">videocam</span>مكتبة الفيديو
    </a>
    @if($user->hasAnyLevel(3, 5, 6))
      <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-base">group</span>إدارة المستخدمين
      </a>
    @endif
    @if($user->hasAnyLevel(3, 6))
      <a href="{{ route('admin.press') }}" class="sidebar-link {{ request()->routeIs('admin.press') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-base">newspaper</span>القصاصات الصحفية
      </a>
      <a href="{{ route('admin.council') }}" class="sidebar-link {{ request()->routeIs('admin.council') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-base">gavel</span>المجلس الإداري
      </a>
      <a href="{{ route('admin.initiatives') }}" class="sidebar-link {{ request()->routeIs('admin.initiatives') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-base">star</span>مبادرات جهوية
      </a>
      <a href="{{ route('admin.magazine') }}" class="sidebar-link {{ request()->routeIs('admin.magazine') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-base">menu_book</span>المجلة الشهرية
      </a>
    @endif
  @endif

  <div class="border-t border-slate-100 my-2 mx-3"></div>
  <span class="sidebar-label">النظام</span>
  {{-- <a href="{{ route('admin.watermark') }}" class="sidebar-link {{ request()->routeIs('admin.watermark') ? 'active' : '' }}">
    <span class="material-symbols-outlined text-base">settings</span>وحدة التحكم
  </a> --}}
  @if($user && $user->hasAnyLevel(1, 2, 3, 5, 6))
    <a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
      <span class="material-symbols-outlined text-base">mail</span>صندوق الرسائل
      <span class="sidebar-count">3</span>
    </a>
  @endif
  <a href="{{ route('admin.account') }}" class="sidebar-link {{ request()->routeIs('admin.account') ? 'active' : '' }}">
    <span class="material-symbols-outlined text-base">person</span>الحساب
  </a>

</aside>
