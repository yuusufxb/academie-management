<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function search(Request $request)
    {
        $results = collect([]);

        if ($request->hasAny(['title','type','responsible','from','to','place'])) {
        }

        return view('admin.search', compact('results'));
    }

    public function watermark()
    {
        return view('admin.watermark');
    }

    public function messages()
    {
        return view('admin.messages');
    }
}
