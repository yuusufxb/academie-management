<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MagazineController extends Controller {

    public function index() {
        // $editions = \App\Models\MagazineEdition::latest()->get();
        $editions = collect([]);
        return view('admin.magazine', compact('editions'));
    }

    public function generate(Request $request) {
        $request->validate(['month' => 'required|string', 'year' => 'required|digits:4']);
        // Generate PDF and store it ...
        // $edition = MagazineEdition::create([
        //     'filename' => "shazrat_tarbiwiya_{$request->month}_{$request->year}.pdf",
        //     'month'    => $request->month,
        //     'year'     => $request->year,
        // ]);
        return back()->with('success', 'تم توليد المجلة بنجاح.');
    }

    public function view($id) {
        // $edition = MagazineEdition::findOrFail($id);
        // return response()->file(storage_path("app/public/magazines/{$edition->filename}"));
        abort(404);
    }

    public function download($id) {
        // $edition = MagazineEdition::findOrFail($id);
        // return response()->download(storage_path("app/public/magazines/{$edition->filename}"));
        abort(404);
    }
}
