<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; 
// use App\Models\Activity;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        // $activities = Activity::query()
        //     ->when($request->q, fn($q, $v) => $q->where('title', 'like', "%$v%"))
        //     ->when($request->type, fn($q, $v) => $q->where('type', $v))
        //     ->latest('date')
        //     ->paginate(20);

        $activities = Activity::latest('date')->paginate(9); // placeholder
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*'    => 'nullable|image|max:5120',
        ]);

        // $activity = Activity::create($data);
        // if ($request->hasFile('photos')) {
        //     foreach ($request->file('photos') as $photo) {
        //         $path = $photo->store('activities', 'public');
        //         $activity->photos()->create(['path' => $path]);
        //     }
        // }

        return redirect()->route('admin.activities.index')
            ->with('success', 'تم إضافة النشاط بنجاح.');
    }

    public function show($id)
    {
        // $activity = Activity::with('photos')->findOrFail($id);
        // return view('admin.activities.show', compact('activity'));
        abort(404);
    }

    public function edit($id)
    {
        // $activity = Activity::findOrFail($id);
        // return view('admin.activities.form', compact('activity'));
        abort(404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*'    => 'nullable|image|max:5120',
        ]);

        // $activity = Activity::findOrFail($id);
        // $activity->update($data);

        return redirect()->route('admin.activities.index')
            ->with('success', 'تم تحديث النشاط بنجاح.');
    }

    public function destroy($id)
    {
        // Activity::findOrFail($id)->delete();
        return redirect()->route('admin.activities.index')
            ->with('success', 'تم حذف النشاط.');
    }

    public function programmed()
    {
        // $programmed = Activity::whereNotNull('scheduled_date')->latest('scheduled_date')->paginate(20);
        $programmed = collect([]);
        return view('admin.activities.programmed', compact('programmed'));
    }

    public function scheduleForm()
    {
        // $activities = Activity::whereNull('scheduled_date')->get();
        $activities = collect([]);
        return view('admin.activities.schedule', compact('activities'));
    }

    public function scheduleStore(Request $request)
    {
        $request->validate([
            'activity_id'    => 'required|exists:activities,id',
            'scheduled_date' => 'required|date',
        ]);

        // Activity::findOrFail($request->activity_id)
        //     ->update(['scheduled_date' => $request->scheduled_date, 'notes' => $request->notes]);

        return redirect()->route('admin.activities.programmed')
            ->with('success', 'تمت برمجة النشاط بنجاح.');
    }
}
