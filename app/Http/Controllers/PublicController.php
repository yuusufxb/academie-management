<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Activity; // uncomment when model exists
use App\Models\Activity;
class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function activities(Request $request)
    {
        // Example with model:
        // $query = Activity::query();
        // if ($request->type)  $query->where('type', $request->type);
        // if ($request->resp)  $query->where('responsible', 'like', "%{$request->resp}%");
        // if ($request->title) $query->where('title', 'like', "%{$request->title}%");
        // if ($request->place) $query->where('place', 'like', "%{$request->place}%");
        // if ($request->from)  $query->where('date', '>=', $request->from);
        // if ($request->to)    $query->where('date', '<=', $request->to);
        // $activities = $query->latest('date')->paginate(9);

        $activities = Activity::latest('date')->paginate(9); // placeholder
        return view('public.activities', compact('activities'));
    }

    public function activityShow($id)
    {
        // $activity = Activity::findOrFail($id);
        // return view('public.activity-detail', compact('activity'));
        abort(404);
    }

    public function media()
    {
        return view('public.media');
    }

    public function initiatives()
    {
        return view('public.initiatives');
    }

    public function council()
    {
        return view('public.council');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function contactSend(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Mail::to('admin@academie.ma')->send(new ContactMail($request->all()));

        return back()->with('success', true);
    }
}
