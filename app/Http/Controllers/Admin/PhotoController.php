<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
{
    // جلب الصور مرتبة من الأحدث إلى الأقدم مع الترقيم
    $photos = Photo::latest('id')->paginate(12);

    // إرسال المتغير باسم $photos ليتوافق مع الـ View
    return view('admin.photos', compact('photos'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'nullable|string|max:255',
            'path'  => 'required|image|max:5120',
            'idact' => 'required|exists:activities,id',
        ]);

        if ($request->hasFile('path')) {
            $data['path'] = $request->file('path')->store('photos', 'public');
        }

        Photo::create($data);

        return back()->with('success', 'تمت إضافة الصورة');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return back()->with('success', 'تم حذف الصورة');
    }
}