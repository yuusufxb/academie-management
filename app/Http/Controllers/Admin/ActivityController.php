<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
{
    $categories = \App\Models\Catigory::all();
    $user = Auth::user();

    $query = \App\Models\Activity::query()->visibleToUser($user);

    if ($request->filled('q')) {
        $query->where('title', 'LIKE', "%{$request->q}%");
    }

    if ($request->filled('typ')) {
        // Cast to integer to avoid string/int mismatch
        $query->where('typ', (int) $request->typ);
    }

    $activities = $query->orderBy('dte', 'desc')->paginate(10);

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
    $data = $request->validate([
        'title'     => 'required|string|max:255',
        'typ'       => 'required',
        'dte'       => 'required|date',
        'hr'        => 'nullable',
        'lieu'      => 'required|string|max:255',
        'resp'      => 'required|string|max:255',
        'benfs'     => 'nullable|string|max:255',
        'nb'        => 'nullable|integer',
        'ref'       => 'nullable|string|max:255',
        'photos'    => 'nullable|array|max:6',
        'photos.*'  => 'image|mimes:jpeg,png,jpg,webp|max:4096',
    ]);

    $user = Auth::user();
    $data['gre'] = $user->gre;
    $data['niv'] = $user->niv;

    $activity = \App\Models\Activity::create($data);

    // Save photos
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('activities', 'public');
            \App\Models\Photo::create([
                'name'  => $photo->getClientOriginalName(),
                'path'  => $path,
                'idact' => $activity->id,
            ]);
        }
    }

    return redirect()->route('admin.activities.index')
        ->with('success', 'تم إضافة النشاط بنجاح.');
}

    public function show($id)
{
    // جلب النشاط مع الفئة لضمان ظهور النوع في الأعلى اليسار
    $activity = \App\Models\Activity::with('catigory')->findOrFail($id);
    $this->authorizeActivity($activity);
    
    return view('admin.activities.show', compact('activity'));
}

    public function edit($id)
{
    $activity   = \App\Models\Activity::with('photos')->findOrFail($id);
    $this->authorizeActivity($activity);
    $categories = \App\Models\Catigory::all();
    return view('admin.activities.edit', compact('activity', 'categories'));
}

public function update(Request $request, $id)
{
    $activity = \App\Models\Activity::with('photos')->findOrFail($id);
    $this->authorizeActivity($activity);

    $data = $request->validate([
        'title'     => 'required|string|max:255',
        'typ'       => 'required',
        'dte'       => 'required|date',
        'hr'        => 'nullable',
        'lieu'      => 'required|string|max:255',
        'resp'      => 'required|string|max:255',
        'benfs'     => 'nullable|string|max:255',
        'nb'        => 'nullable|integer',
        'ref'       => 'nullable|string|max:255',
        'photos'    => 'nullable|array',
        'photos.*'  => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        'remove_photos' => 'nullable|array',
    ]);

    $activity->update($data);

    // Delete photos marked for removal
    if ($request->filled('remove_photos')) {
        foreach ($request->remove_photos as $photoId) {
            $photo = \App\Models\Photo::find($photoId);
            if ($photo && $photo->idact == $activity->id) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
        }
    }

    // Count remaining photos after deletion
    $existingCount = $activity->photos()->count();

    // Add new photos (respect max 6)
    if ($request->hasFile('photos')) {
        $allowed = 6 - $existingCount;
        foreach (array_slice($request->file('photos'), 0, $allowed) as $photo) {
            $path = $photo->store('activities', 'public');
            \App\Models\Photo::create([
                'name'  => $photo->getClientOriginalName(),
                'path'  => $path,
                'idact' => $activity->id,
            ]);
        }
    }

    return redirect()->route('admin.activities.edit', $activity->id)
        ->with('success', 'تم تحديث النشاط بنجاح.');
}

public function destroy($id)
{
    $activity = \App\Models\Activity::with('photos')->findOrFail($id);
    $this->authorizeActivity($activity);

    // Delete all photo files from storage
    foreach ($activity->photos as $photo) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($photo->path);
        $photo->delete();
    }

    $activity->delete();

    return redirect()->route('admin.activities.index')
        ->with('success', 'تم حذف النشاط بنجاح.');
}

private function applyActivityScope($query, $user): void
{
    $query->visibleToUser($user);
}

private function authorizeActivity(Activity $activity): void
{
    $user = Auth::user();

    if (!$user) {
        abort(403, 'غير مصرح لك بالوصول.');
    }

    $allowed = Activity::query()
        ->visibleToUser($user)
        ->whereKey($activity->getKey())
        ->exists();

    if (!$allowed) {
        abort(403, 'ليس لديك الصلاحية للوصول إلى هذا النشاط.');
    }
}
   
}
