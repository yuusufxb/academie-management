<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qossassa;

class MagazineController extends Controller
{
    public function index()
    {
        $editions = Qossassa::latest('dte')->paginate(10);

        return view('admin.magazine', compact('editions'));
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'journal' => 'required|string|max:255',
            'dte'     => 'required|date',
            'titre'   => 'required|string|max:255',
            'lien'    => 'nullable|url',
            'photo'   => 'nullable|image|max:5120',
            'txt'     => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('magazines', 'public');
        }

        Qossassa::create($data);

        return back()->with('success', 'تم إنشاء المجلة بنجاح');
    }

    public function view($id)
    {
        $edition = Qossassa::findOrFail($id);

        return view('admin.magazine-show', compact('edition'));
    }

    public function download($id)
    {
        $edition = Qossassa::findOrFail($id);

        return response()->download(storage_path('app/public/' . $edition->photo));
    }
}