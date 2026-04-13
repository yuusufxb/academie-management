<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\CAdmin; // Remplacement de Council par CAdmin
use App\Models\Report;
use App\Models\Mail;   // Ajout du modèle Mail pour le formulaire de contact

class PublicController extends Controller
{
   public function home()
{
    // 1. إحصائيات الأنشطة
    $totalActivities = Activity::count();
    $schoolsCount = Activity::distinct('lieu')->count(); // حساب عدد المؤسسات بناءً على مكان النشاط
    
    // 2. جلب آخر 3 أنشطة للوحة التتبع الصغيرة
    $recent_activities = Activity::latest()->take(3)->get();

    // 3. جلب آخر 3 دورات للمجلس الإداري
    $councils = CAdmin::latest()->take(3)->get();

    return view('public.home', compact('totalActivities', 'schoolsCount', 'recent_activities', 'councils'));
}

    // ================= ACTIVITIES =================
    public function activities(Request $request)
{
    $query = Activity::with(['mainPhoto', 'photos']);

    // --- APPLY FILTERS ---
    if ($request->filled('type')) {
        $query->where('typ', $request->type); // Matching 'typ' column
    }
    if ($request->filled('resp')) {
        $query->where('resp', 'like', '%' . $request->resp . '%');
    }
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }
    if ($request->filled('place')) {
        $query->where('lieu', 'like', '%' . $request->place . '%');
    }
    if ($request->filled('from')) {
        $query->whereDate('dte', '>=', $request->from);
    }
    if ($request->filled('to')) {
        $query->whereDate('dte', '<=', $request->to);
    }

    $activities = $query->latest('dte')->paginate(9);
    
    // Get categories for the filter dropdown
    $categories = \App\Models\Catigory::all();

    return view('public.activities', compact('activities', 'categories'));
}

    public function activityShow($id)
    {
        // Eager loading des relations que nous avons configurées
        $activity = Activity::with(['photos', 'reports'])->findOrFail($id);

        return view('public.activity-show', compact('activity'));
    }

    // ================= INITIATIVES =================
    public function initiatives()
    {
        // Remplacement de 'date' par 'created_at' (reports n'a pas de colonne date)
        // Eager loading de 'activity' au cas où tu voudrais afficher le nom de l'activité liée
        $initiatives = Report::with('activity')->latest('created_at')->paginate(9);

        return view('public.initiatives', compact('initiatives'));
    }

    public function initiativeShow($id)
    {
        // Chargement de l'initiative, de l'activité liée, et de l'utilisateur qui a rédigé le rapport
        $initiative = Report::with(['activity', 'user'])->findOrFail($id);

        return view('public.initiative-show', compact('initiative'));
    }

    // ================= COUNCIL =================
    public function council()
    {
        // Remplacement du modèle Council par CAdmin et tri par la colonne 'dte'
        $councils = CAdmin::latest('dte')->paginate(9);

        return view('public.council', compact('councils'));
    }

    public function councilShow($id)
    {
        // Remplacement du modèle Council par CAdmin
        $council = CAdmin::findOrFail($id);

        return view('public.council-show', compact('council'));
    }

    // ================= OTHER =================
    public function media()
    {
        // (Optionnel) Si tu veux envoyer les données de ta table 'media' vers la vue plus tard :
        // $medias = \App\Models\Media::latest()->paginate(12);
        // return view('public.media', compact('medias'));
        $medias = \App\Models\Media::latest()->paginate(10);
        $sidebarMedias = \App\Models\Media::latest()->take(3)->get();
        return view('public.media', compact('medias', 'sidebarMedias'));
    }
    public function stars()
{
    // جلب المبادرات المتميزة مع الصور
    $initiatives = \App\Models\Star::with(['mainPhoto', 'photos'])->latest()->paginate(9);

    return view('public.initiative', compact('initiatives'));
}
    public function showStar($id)
{
    // جلب المبادرة مع النشاط المرتبط بها
    $initiative = \App\Models\Star::with('activity')->findOrFail($id);

    return view('public.initiative-show', compact('initiative'));
}

    public function contact()
    {
        return view('public.contact');
    }

    public function contactSend(Request $request)
    {
        // Validation (ajout de 'subject' pour coller à ta colonne 'objet')
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255', 
            'message' => 'required|string|min:10',
        ]);

        // Sauvegarde dans la base de données (Table 'mails')
        Mail::create([
            'nom'    => $request->name,
            'email'  => $request->email,
            'objet'  => $request->subject ?? 'Message depuis le site web', // Valeur par défaut
            'msg'    => $request->message,
            'ipfrom' => $request->ip(), // Récupère l'IP du visiteur
            'vu'     => 0, // Non lu par défaut
            'gre'    => 1011 // Valeur par défaut d'après ta migration
        ]);

        return back()->with('success', true);
    }
}