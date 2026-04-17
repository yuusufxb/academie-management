<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
{
    // استخدام with('user') لجلب بيانات أصحاب الرسائل بطلب واحد
    $messages = Mail::with('user')
        ->visibleToUser(Auth::user())
        ->latest('created_at')
        ->paginate(10);

    return view('admin.messages', compact('messages'));
}

    public function show($id)
    {
        $message = Mail::with('user')
            ->visibleToUser(Auth::user())
            ->findOrFail($id);

        // نقدر نعلم الرسالة مقروءة
        $message->update(['vu' => 1]);

        return view('admin.message-show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Mail::visibleToUser(Auth::user())->findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')
            ->with('success', 'تم حذف الرسالة');
    }
}