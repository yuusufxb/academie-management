<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\CAdmin; // تغيير من Council إلى CAdmin
use App\Models\Report;
use App\Models\Etabz;
use App\Models\Mail;
use App\Models\ZProv;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // ================= لوحة التحكم (DASHBOARD) =================
    public function index()
    {
        $user = Auth::user();
        $activityQuery = Activity::query()->visibleToUser($user);

        $stats = [
            'activities'  => (clone $activityQuery)->count(),
            'councils'    => CAdmin::count(), // استخدام الموديل الجديد
            'etabl' => Etabz::count(),
            'provinces'    => ZProv::count(),
        ];

        // جلب آخر البيانات باستخدام حقل dte للمجلس الإداري
        $latestActivities  = (clone $activityQuery)->latest('dte')->take(5)->get();
        $latestCouncils    = CAdmin::latest('dte')->take(5)->get(); // التغيير هنا dte
        $latestInitiatives = Report::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'latestActivities',
            'latestCouncils',
            'latestInitiatives'
        ));
    }

    // ================= البحث (SEARCH) =================
   public function search(Request $request)
{
    $query = Activity::query()->visibleToUser(Auth::user());

    if ($request->filled('title')) $query->where('title', 'like', "%{$request->title}%");
    
    // تأكد أن البحث يتم على عمود 'typ' بالقيمة المختارة
    if ($request->filled('type')) {
        $query->where('typ', $request->type);
    }
    
    if ($request->filled('responsible')) $query->where('resp', 'like', "%{$request->responsible}%");
    if ($request->filled('place')) $query->where('lieu', 'like', "%{$request->place}%");
    
    if ($request->filled('from')) $query->whereDate('dte', '>=', $request->from);
    if ($request->filled('to')) $query->whereDate('dte', '<=', $request->to);

    $results = $query->latest('dte')->get();

    return view('admin.search', compact('results'));
}
    // ================= العلامة المائية (WATERMARK) =================
    public function watermark()
    {
        return view('admin.watermark');
    }

    // ================= الرسائل (MESSAGES) =================
    public function messages()
    {
        $messages = Mail::visibleToUser(Auth::user())->latest()->paginate(10);
        return view('admin.messages', compact('messages'));
    }

    public function iqlimDashboard()
    {
        abort_unless(Auth::user() && Auth::user()->canAccessIqlimDashboard(), 403);
        return $this->index();
    }

    public function academyDashboard()
    {
        abort_unless(Auth::user() && Auth::user()->canAccessAcademyDashboard(), 403);
        return $this->index();
    }
}