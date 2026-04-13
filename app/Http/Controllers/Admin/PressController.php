<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qossassa;

class PressController extends Controller
{
    public function index()
    {
        $clippings = \App\Models\Qossassa::latest('dte')->get();

        return view('admin.press', compact('clippings'));
    }

    public function create()
    {
        return view('admin.press-form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'journal' => 'required|string|max:255',
            'dte'     => 'required|date',
            'titre'   => 'required|string|max:255',
            'lien'    => 'nullable|url',
            'photo'   => 'nullable|image|max:5120',
            'txt'     => 'nullable|string',
        ]);

        $data['gre'] = 1;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('press', 'public');
        }

        Qossassa::create($data);

        return redirect()->route('admin.press')
           ->with('success', 'تمت إضافة القصاصة بنجاح');
    }

    public function show($id)
    {
        $clipping = Qossassa::findOrFail($id);

        return view('admin.press-show', compact('clipping'));
    }

    public function edit($id)
    {
        $clipping = Qossassa::findOrFail($id);

        return view('admin.press-edit', compact('clipping'));
    }

    public function update(Request $request, $id)
    {
        $clipping = Qossassa::findOrFail($id);

        $data = $request->validate([
            'journal' => 'required|string|max:255',
            'dte'     => 'required|date',
            'titre'   => 'required|string|max:255',
            'lien'    => 'nullable|url',
            'photo'   => 'nullable|image|max:5120',
            'txt'     => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('press', 'public');
        }

        $clipping->update($data);

        return redirect()->route('admin.press')
            ->with('success', 'تم التحديث');
    }

    public function destroy($id)
    {
        $clipping = Qossassa::findOrFail($id);
        $clipping->delete();

        return back()->with('success', 'تم الحذف');
    }
}