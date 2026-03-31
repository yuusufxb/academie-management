<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MagazineController extends Controller {

    public function index() {
        $editions = collect([]);
        return view('admin.magazine', compact('editions'));
    }

    public function generate(Request $request) {
        $request->validate(['month' => 'required|string', 'year' => 'required|digits:4']);
        return back()->with('success', 'تم توليد المجلة بنجاح.');
    }

    public function view($id) {
        abort(404);
    }

    public function download($id) {
        abort(404);
    }
}
