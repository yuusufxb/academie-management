<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class InitiativeController extends Controller {
    public function index() {
        // $initiatives = \App\Models\Initiative::latest()->paginate(20);
        $initiatives = collect([]);
        return view('admin.initiatives', compact('initiatives'));
    }
}
