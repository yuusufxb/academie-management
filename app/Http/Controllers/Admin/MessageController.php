<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail;

class MessageController extends Controller
{
    public function index()
{
    // استخدام with('user') لجلب بيانات أصحاب الرسائل بطلب واحد
    $messages = Mail::with('user')->latest('created_at')->paginate(10);

    return view('admin.messages', compact('messages'));
}

    public function show($id)
    {
        $message = Mail::findOrFail($id);

        // نقدر نعلم الرسالة مقروءة
        $message->update(['vu' => 1]);

        return view('admin.message-show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Mail::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')
            ->with('success', 'تم حذف الرسالة');
    }
}