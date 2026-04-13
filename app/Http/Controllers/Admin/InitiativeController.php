<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report; // استخدام الموديل الجديد
use Illuminate\Support\Facades\Auth;

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
            'image'  => 'nullable|image|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'rap'   => $request->report, // تحويل report إلى rap لتناسب الموديل
            'byu'   => Auth::id(),      // تعيين معرف المستخدم الحالي للحقل byu
            'vu'    => 0,                // قيمة افتراضية للحقل vu
            'idact' => $request->idact ?? 1, // ربطها بنشاط معين حسب الحاجة
        ];

        if ($request->hasFile('image')) {
            // ملاحظة: إذا كان الموديل لا يحتوي على حقل image أو tof، يجب إضافته للـ fillable
            $data['image'] = $request->file('image')->store('initiatives', 'public');
        }

        Report::create($data);

        return redirect()->route('admin.initiatives')
            ->with('success', 'تمت إضافة المبادرة');
    }

    public function show($id)
    {
        $initiative = Report::findOrFail($id);
        return view('admin.initiative-show', compact('initiative'));
    }

    public function edit($id)
    {
        $initiative = Report::findOrFail($id);
        return view('admin.initiative-edit', compact('initiative'));
    }

    public function update(Request $request, $id)
    {
        $initiative = Report::findOrFail($id);

        $request->validate([
            'title'  => 'required|string|max:255',
            'report' => 'required|string',
            'image'  => 'nullable|image|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'rap'   => $request->report, // تحويل report إلى rap
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('initiatives', 'public');
        }

        $initiative->update($data);

        return redirect()->route('admin.initiatives')
            ->with('success', 'تم تحديث المبادرة');
    }

    public function destroy($id)
    {
        $initiative = Report::findOrFail($id);
        $initiative->delete();

        return redirect()->route('admin.initiatives')
            ->with('success', 'تم حذف المبادرة');
    }
}