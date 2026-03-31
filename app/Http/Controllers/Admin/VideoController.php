<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class VideoController extends Controller {
    public function index() {
        $videos = collect([]);
        return view('admin.videos', compact('videos'));
    }
}
