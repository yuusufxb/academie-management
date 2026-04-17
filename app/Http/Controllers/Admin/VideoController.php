<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * عرض قائمة الفيديوهات
     * niv 2,3,5,6 : catalogue global (sans filtre activité)
     */
    public function index()
    {
        $user = Auth::user();
        $query = Media::with('activity');

        if ($user && $user->hasAnyLevel(
            User::LEVEL_SUPERVISOR,
            User::LEVEL_DIRECTOR,
            User::LEVEL_PROVINCIAL_ADMIN,
            User::LEVEL_ACADEMY_ADMIN
        )) {
            $videos = $query->latest('id')->paginate(10);
        } else {
            $videos = $query->visibleToUser($user)->latest('id')->paginate(10);
        }

        return view('admin.videos', compact('videos'));
    }

    /**
     * عرض صفحة إضافة فيديو جديد
     * niv 3 et 6 : toutes les activités
     */
    public function create()
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403);
        $activities = Activity::query()->orderByDesc('dte')->get();

        return view('admin.video-form', compact('activities'));
    }

    /**
     * حفظ الفيديو الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403);

        $data = $request->validate([
            'typ'   => 'required',
            'title' => 'required|string|max:255',
            'link'  => 'required|string',
            'tof'   => 'nullable|string',
            'idact' => 'required|exists:activities,id',
        ]);

        Activity::query()->findOrFail($data['idact']);

        Media::create($data);

        return redirect()->route('admin.videos')->with('success', 'تمت إضافة الفيديو بنجاح');
    }

    /**
     * عرض تفاصيل فيديو محدد
     */
    public function show($id)
    {
        $user = Auth::user();
        $base = Media::with('activity');

        if ($user && $user->hasAnyLevel(
            User::LEVEL_SUPERVISOR,
            User::LEVEL_DIRECTOR,
            User::LEVEL_PROVINCIAL_ADMIN,
            User::LEVEL_ACADEMY_ADMIN
        )) {
            $video = $base->findOrFail($id);
        } else {
            $video = $base->visibleToUser($user)->findOrFail($id);
        }

        return view('admin.video-show', compact('video'));
    }

    /**
     * عرض صفحة تعديل الفيديو
     */
    public function edit($id)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403);
        $video = Media::with('activity')->findOrFail($id);
        $activities = Activity::query()->orderByDesc('dte')->get();

        return view('admin.video-form', compact('video', 'activities'));
    }

    /**
     * تحديث بيانات الفيديو في قاعدة البيانات
     */
    public function update(Request $request, $id)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403);
        $video = Media::findOrFail($id);

        $data = $request->validate([
            'typ'   => 'required',
            'title' => 'required|string|max:255',
            'link'  => 'required|string',
            'tof'   => 'nullable|string',
            'idact' => 'required|exists:activities,id',
        ]);

        Activity::query()->findOrFail($data['idact']);

        $video->update($data);

        return redirect()->route('admin.videos')->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * حذف الفيديو
     */
    public function destroy($id)
    {
        abort_unless(Auth::user() && Auth::user()->canManageMedia(), 403);
        Media::findOrFail($id)->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }

}
