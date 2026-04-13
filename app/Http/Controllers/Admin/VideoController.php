<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media; 

class VideoController extends Controller
{
    /**
     * عرض قائمة الفيديوهات
     */
    public function index()
    {
        $videos = Media::latest('id')->paginate(10);
        return view('admin.videos', compact('videos'));
    }

    /**
     * عرض صفحة إضافة فيديو جديد
     */
    public function create()
    {
        return view('admin.video-form');
    }

    /**
     * حفظ الفيديو الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        // 1. التحقق من البيانات (تم تعديل tof ليكون نصاً و typ ليقبل الأرقام القادمة من الفورم)
        $data = $request->validate([
            'typ'   => 'required',
            'title' => 'required|string|max:255',
            'link'  => 'required|string',
            'tof'   => 'nullable|string', // تم تغييره من image إلى string ليصبح "المعرف"
        ]);

        // 2. إنشاء السجل في قاعدة البيانات
        Media::create($data);

        // 3. التوجه لصفحة الجدول مع رسالة نجاح
        // ملاحظة: تأكد أن اسم المسار هو 'admin.videos' في ملف web.php
        return redirect()->route('admin.videos')->with('success', 'تمت إضافة الفيديو بنجاح');
    }

    /**
     * عرض تفاصيل فيديو محدد
     */
    public function show($id)
    {
        $video = Media::findOrFail($id);
        return view('admin.video-show', compact('video'));
    }

    /**
     * عرض صفحة تعديل الفيديو
     */
    public function edit($id)
    {
        $video = Media::findOrFail($id);
        return view('admin.video-form', compact('video'));
    }

    /**
     * تحديث بيانات الفيديو في قاعدة البيانات
     */
    public function update(Request $request, $id)
    {
        $video = Media::findOrFail($id);

        // 1. التحقق من البيانات
        $data = $request->validate([
            'typ'   => 'required',
            'title' => 'required|string|max:255',
            'link'  => 'required|string',
            'tof'   => 'nullable|string', // تم التعديل ليتوافق مع "المعرف"
        ]);

        // 2. تحديث السجل
        $video->update($data);

        return redirect()->route('admin.videos')->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * حذف الفيديو
     */
    public function destroy($id)
    {
        Media::findOrFail($id)->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}