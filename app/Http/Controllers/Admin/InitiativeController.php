<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class InitiativeController extends Controller {
    public function index() {
        $initiatives = collect([]);
        return view('admin.initiatives', compact('initiatives'));
    }
}
