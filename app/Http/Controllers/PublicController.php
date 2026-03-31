<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function activities(Request $request)
    {

        $activities = Activity::latest('date')->paginate(9); // placeholder
        return view('public.activities', compact('activities'));
    }

    public function activityShow($id)
    {
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

        return back()->with('success', true);
    }
}
