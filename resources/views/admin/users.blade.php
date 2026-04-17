@extends('layouts.admin')
@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')
@section('content')

    <h2 class="font-headline text-xl font-black text-slate-900 mb-4">إدارة المستخدمين</h2>

    @if (session('success'))
        <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-right text-sm font-bold text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-right text-sm font-bold text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex gap-3 mb-4">
    <form action="{{ route('admin.users') }}" method="GET" class="flex-1 flex gap-2">
        {{-- حقل البحث --}}
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="بحث بالاسم، البريد، أو رمز المؤسسة..." 
            class="flex-1 bg-white border border-slate-200 rounded-md px-4 py-2.5 text-sm focus:ring-2 focus:ring-secondary/20 text-right font-body"
        />

        {{-- زر البحث --}}
        <button type="submit" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-all">
            <span class="material-symbols-outlined text-base">search</span>
            بحث
        </button>

        {{-- زر المسح (يظهر فقط إذا كان هناك بحث نشط) --}}
        @if(request('search'))
            <a href="{{ route('admin.users') }}" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2 hover:bg-slate-200 transition-all">
                <span class="material-symbols-outlined text-base">close</span>
               
            </a>
        @endif
    </form>
    
    @if(auth()->user()->canCreateUsers())
        <a href="{{ route('admin.users.create') }}" class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold flex items-center justify-center">إنشاء</a>
    @endif
    <button class="border border-outline-variant text-primary px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">download</span>
        تصدير (.xlsx)
    </button>
</div>

    <div class="bg-surface-container-lowest rounded-md overflow-hidden">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>المستوى</th>
                    <th>رمز المؤسسة</th>
                    <th>الإقليم</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="font-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- استخدام حقل niv من الموديل --}}
                        <td>{{ $user->niv ?? 1 }}</td>
                        {{-- استخدام حقل gre من الموديل --}}
                        <td>{{ $user->gre ?? '—' }}</td>
                        <td class="text-xs text-slate-600 max-w-[140px]">{{ $user->provinceLabel() ?? '—' }}</td>
                        <td>
                            <div class="flex gap-1 flex-wrap">
                                {{-- ربط الأزرار بالمسارات الصحيحة --}}
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="border border-slate-200 text-slate-700 px-3 py-1 rounded-md text-xs font-bold hover:bg-slate-50">عرض</a>

                                @if(auth()->user()->canEditUsers())
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="bg-secondary/10 text-secondary px-3 py-1 rounded-md text-xs font-bold hover:bg-secondary/20">تعديل</a>
                                @endif

                                @if(auth()->user()->canFullyManageUsers())
                                    <form method="POST" action="{{ route('admin.users.reset-password', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-amber-50 text-amber-700 px-3 py-1 rounded-md text-xs font-bold">
                                            إعادة التعيين
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.users.send-credentials', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-slate-800 text-white px-3 py-1 rounded-md text-xs font-bold">
                                            إرسال بيانات الدخول
                                        </button>
                                    </form>
                                @endif

                                {{-- إضافة زر الحذف بنفس التنسيق --}}

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-slate-400">لا يوجد مستخدمون حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- إضافة الترقيم (Pagination) بنفس ستايل النظام --}}
    <div class="mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>

@endsection
