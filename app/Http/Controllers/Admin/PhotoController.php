<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
{
    // جلب الصور مرتبة من الأحدث إلى الأقدم مع الترقيم
    $photos = Photo::with('activity')
        ->visibleToUser(Auth::user())
        ->latest('id')
        ->paginate(12);

    // إرسال المتغير باسم $photos ليتوافق مع الـ View
    return view('admin.photos', compact('photos'));
}

    public function store(Request $request)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403, 'ليس لديك الصلاحية لإضافة الوسائط.');

        $data = $request->validate([
            'name'  => 'nullable|string|max:255',
            'path'  => 'required|image|max:5120',
            'idact' => 'required|exists:activities,id',
        ]);

        $activity = Activity::query()->visibleToUser(Auth::user())->findOrFail($data['idact']);

        if ($request->hasFile('path')) {
            $data['path'] = $request->file('path')->store('photos', 'public');
        }

        Photo::create([
            ...$data,
            'idact' => $activity->id,
        ]);

        return back()->with('success', 'تمت إضافة الصورة');
    }

    public function destroy($id)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403, 'ليس لديك الصلاحية لحذف الوسائط.');

        $photo = Photo::query()
            ->visibleToUser(Auth::user())
            ->findOrFail($id);
        $photo->delete();

        return back()->with('success', 'تم حذف الصورة');
    }
}