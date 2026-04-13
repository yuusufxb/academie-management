<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CAdmin;

class CouncilController extends Controller
{
    public function index()
    {
        // جلب البيانات الفعلية من قاعدة البيانات
        $councils = CAdmin::latest('dte')->get(); 
        return view('admin.council', compact('councils'));
    }

    public function create()
    {
        return view('admin.council-form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'yr'   => 'required|digits:4',
            'mois' => 'required|string|max:100',
            'lieu' => 'required|string|max:255',
            'dte'  => 'required|date',
            'rap'  => 'nullable|string',
            'tof'  => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('tof')) {
            $data['tof'] = $request->file('tof')->store('councils', 'public');
        }

        CAdmin::create($data);

        return redirect()->route('admin.council')->with('success', 'تمت إضافة الدورة بنجاح');
    }

    public function show($id)
    {
        $council = CAdmin::findOrFail($id);
        return view('admin.council-show', compact('council'));
    }

    public function edit($id)
{
    // 1. جلب البيانات
    $council = CAdmin::findOrFail($id);
    
    // 2. التأكد من اسم الملف الصحيح (council-edit وليس council-form)
    return view('admin.council-edit', compact('council')); 
}

public function update(Request $request, $id)
{
    $council = CAdmin::findOrFail($id);

    $data = $request->validate([
        'yr'   => 'required|digits:4',
        'mois' => 'required|string|max:100',
        'lieu' => 'required|string|max:255',
        'dte'  => 'required|date',
        'rap'  => 'nullable|string',
        'tof'  => 'nullable|image|max:5120',
    ]);

    if ($request->hasFile('tof')) {
        // حذف الصورة القديمة إذا كنت تريد توفير مساحة (اختياري)
        // if($council->tof) Storage::disk('public')->delete($council->tof);
        
        $data['tof'] = $request->file('tof')->store('councils', 'public');
    }

    $council->update($data);

    // التأكد من أن اسم الـ route هو admin.council كما في ملف web.php الخاص بك
    return redirect()->route('admin.council')->with('success', 'تم تحديث الدورة بنجاح');
}
    public function destroy($id)
    {
        $council = CAdmin::findOrFail($id);
        $council->delete();
        return redirect()->route('admin.council')->with('success', 'تم حذف الدورة');
    }
}