<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class PhotoController extends Controller {
    public function index() {
        $photos = collect([]);
        return view('admin.photos', compact('photos'));
    }
}
    