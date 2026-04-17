<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report; // استخدام الموديل الجديد
use Illuminate\Support\Facades\Auth;
use App\Models\InitiativePhoto;
use Illuminate\Support\Facades\Storage;

class InitiativeController extends Controller
{
    public function index()
    {
        // الموديل الجديد لا يحتوي على حقل باسم date، نستخدم الترتيب الافتراضي أو created_at
        $initiatives = Report::latest()->paginate(10);

        return view('admin.initiatives', compact('initiatives'));
    }

    public function create()
    {
        return view('admin.initiative-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'report' => 'required|string', // هذا القادم من الـ Form
            'photos' => 'nullable|array|max:6',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'rap'   => $request->report, // تحويل report إلى rap لتناسب الموديل
            'byu'   => Auth::id(),      // تعيين معرف المستخدم الحالي للحقل byu
            'vu'    => 0,                // قيمة افتراضية للحقل vu
            'idact' => $request->idact ?? 1, // ربطها بنشاط معين حسب الحاجة
        ];

        $initiative = Report::create($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('initiative-photos', 'public');
                InitiativePhoto::create([
                    'idrep' => $initiative->id,
                    'name'  => $photo->getClientOriginalName(),
                    'path'  => $path,
                ]);
            }
        }

        return redirect()->route('admin.initiatives')
            ->with('success', 'تمت إضافة المبادرة');
    }

    public function show($id)
    {
        $initiative = Report::with('photos')->findOrFail($id);
        return view('admin.initiative-show', compact('initiative'));
    }

    public function edit($id)
    {
        $initiative = Report::with('photos')->findOrFail($id);
        return view('admin.initiative-edit', compact('initiative'));
    }

    public function update(Request $request, $id)
    {
        $initiative = Report::with('photos')->findOrFail($id);

        $request->validate([
            'title'  => 'required|string|max:255',
            'report' => 'required|string',
            'photos' => 'nullable|array|max:6',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_photos' => 'nullable|array',
        ]);

        $data = [
            'title' => $request->title,
            'rap'   => $request->report, // تحويل report إلى rap
        ];

        $initiative->update($data);

        // Delete photos marked for removal
        if ($request->filled('remove_photos')) {
            foreach ($request->remove_photos as $photoId) {
                $photo = InitiativePhoto::find($photoId);
                if ($photo && (int) $photo->idrep === (int) $initiative->id) {
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }
            }
        }

        // Re-count remaining photos after deletions
        $existingCount = $initiative->photos()->count();

        // Add new photos (respect max 6 total)
        if ($request->hasFile('photos')) {
            $allowed = max(0, 6 - $existingCount);
            foreach (array_slice($request->file('photos'), 0, $allowed) as $photo) {
                $path = $photo->store('initiative-photos', 'public');
                InitiativePhoto::create([
                    'idrep' => $initiative->id,
                    'name'  => $photo->getClientOriginalName(),
                    'path'  => $path,
                ]);
            }
        }

        return redirect()->route('admin.initiatives')
            ->with('success', 'تم تحديث المبادرة');
    }

    public function destroy($id)
    {
        $initiative = Report::with('photos')->findOrFail($id);

        foreach ($initiative->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        $initiative->delete();

        return redirect()->route('admin.initiatives')
            ->with('success', 'تم حذف المبادرة');
    }
}