<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; 

class ActivityController extends Controller
{
    public function index(Request $request)
{
    // جلب الفئات ضروري جداً لكي لا تفرغ القائمة بعد البحث
    $categories = \App\Models\Catigory::all(); 

    $query = \App\Models\Activity::query();

    if ($request->filled('q')) {
        $query->where('title', 'LIKE', "%{$request->q}%");
    }

    if ($request->filled('typ')) {
        $query->where('typ', $request->typ);
    }

    $activities = $query->orderBy('dte', 'desc')->paginate(10);

    // نرسل نفس المتغيرات التي يحتاجها التصميم ليبقى ثابتاً
    return view('admin.activities.index', compact('activities', 'categories'));
}

    public function create()
{
    // جلب الفئات من قاعدة البيانات لعرضها في القائمة
    $categories = \App\Models\Catigory::all();
    return view('admin.activities.form', compact('categories'));
}

public function store(Request $request)
{
    // التحقق من البيانات باستخدام أسماء الأعمدة الحقيقية في جدولك
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'typ'   => 'required', // العمود المسؤول عن نوع النشاط
        'dte'   => 'required|date',
        'hr'    => 'nullable',
        'lieu'  => 'required|string|max:255',
        'resp'  => 'required|string|max:255',
        'benfs' => 'nullable|string|max:255',
        'nb'    => 'nullable|integer',
        'ref'   => 'nullable|string|max:255',
    ]);
    $data['gre'] = 1;
    $data['niv'] = 1;

    // حفظ النشاط
    \App\Models\Activity::create($data);

    return redirect()->route('admin.activities.index')
        ->with('success', 'تم إضافة النشاط بنجاح.');
}

    public function show($id)
{
    // جلب النشاط مع الفئة لضمان ظهور النوع في الأعلى اليسار
    $activity = \App\Models\Activity::with('catigory')->findOrFail($id);
    
    return view('admin.activities.show', compact('activity'));
}

    public function edit($id)
{
    // جلب النشاط من قاعدة البيانات
    $activity = \App\Models\Activity::findOrFail($id);
    
    // جلب جميع الفئات لعرضها في قائمة "نوع النشاط"
    $categories = \App\Models\Catigory::all(); 

    return view('admin.activities.edit', compact('activity', 'categories'));
}

public function update(Request $request, $id)
{
    $activity = \App\Models\Activity::findOrFail($id);

    // التحقق من صحة البيانات باستخدام أسماء أعمدة قاعدة بياناتك الحقيقية
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'typ'   => 'required', // رقم الفئة
        'dte'   => 'required|date',
        'hr'    => 'nullable',
        'lieu'  => 'required|string|max:255',
        'resp'  => 'required|string|max:255',
        'benfs' => 'nullable|string|max:255',
        'nb'    => 'nullable|integer',
        'ref'   => 'nullable|string|max:255',
    ]);

    // تحديث البيانات في قاعدة البيانات
    $activity->update($data);

    return redirect()->route('admin.activities.index')
        ->with('success', 'تم تحديث النشاط بنجاح.');
}

    public function destroy($id)
{
    // 1. البحث عن النشاط في قاعدة البيانات
    $activity = \App\Models\Activity::findOrFail($id);

    // 2. حذف النشاط فعلياً
    $activity->delete();

    // 3. إعادة التوجيه مع رسالة النجاح
    return redirect()->route('admin.activities.index')
        ->with('success', 'تم حذف النشاط بنجاح.');
}

   
}
