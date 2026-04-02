<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; 

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::latest('date')->paginate(9); // placeholder
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*'    => 'nullable|image|max:5120',
        ]);


        return redirect()->route('admin.activities.index')
            ->with('success', 'تم إضافة النشاط بنجاح.');
    }

    public function show($id)
    {
        return view('admin.activities.show');
    }

    public function edit($id)
    {
        return view('admin.activities.edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*'    => 'nullable|image|max:5120',
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', 'تم تحديث النشاط بنجاح.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.activities.index')
            ->with('success', 'تم حذف النشاط.');
    }

   
}
