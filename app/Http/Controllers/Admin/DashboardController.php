<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $stats = [
        //     'academies'   => 58,
        //     'directions'  => 68,
        //     'institutions'=> 442,
        //     'activities'  => Activity::count(),
        // ];
        return view('admin.dashboard');
    }

    public function search(Request $request)
    {
        $results = collect([]);

        if ($request->hasAny(['title','type','responsible','from','to','place'])) {
            // $query = Activity::query();
            // if ($request->title)       $query->where('title', 'like', "%{$request->title}%");
            // if ($request->type)        $query->where('type', $request->type);
            // if ($request->responsible) $query->where('responsible', 'like', "%{$request->responsible}%");
            // if ($request->from)        $query->where('date', '>=', $request->from);
            // if ($request->to)          $query->where('date', '<=', $request->to);
            // if ($request->place)       $query->where('place', 'like', "%{$request->place}%");
            // $results = $query->get();
        }

        return view('admin.search', compact('results'));
    }

    public function watermark()
    {
        return view('admin.watermark');
    }

    public function messages()
    {
        // $messages = Message::latest()->get();
        return view('admin.messages');
    }
}
