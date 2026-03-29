<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class PressController extends Controller {
    public function index() {
        // $clippings = \App\Models\PressClipping::latest()->paginate(20);
        $clippings = collect([]);
        return view('admin.press', compact('clippings'));
    }
}
