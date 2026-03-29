<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class CouncilController extends Controller {
    public function index() {
        // $sessions = \App\Models\CouncilSession::latest()->paginate(20);
        return view('admin.council');
    }
}
