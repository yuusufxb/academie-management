<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * معالجة محاولة تسجيل الدخول
     */
    public function login(Request $request)
    {
        // 1. التحقق من صحة المدخلات
        $request->validate([
            'username' => 'required|email', // المستخدم يدخل البريد الإلكتروني
            'password' => 'required|string',
            'role'     => 'required|string', // (مؤسسة، إقليم، أكاديمية)
        ], [
            'username.required' => 'يرجى إدخال البريد الإلكتروني',
            'username.email'    => 'صيغة البريد الإلكتروني غير صحيحة',
            'password.required' => 'يرجى إدخال القن السري',
        ]);

        // 2. إعداد بيانات الاعتماد
        // نربط 'username' من النموذج بحقل 'email' في قاعدة البيانات
        $credentials = [
            'email'    => $request->username,
            'password' => $request->password,
        ];

        // 3. محاولة تسجيل الدخول
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // 4. التحقق من "الدور" المختار مقابل "المستوى" في قاعدة البيانات (niv)
            // niv: 1 => مؤسسة | 2 => إقليم | 3 => أكاديمية
            $isAllowed = false;
            
            if ($request->role === 'مؤسسة' && $user->niv == 1) $isAllowed = true;
            elseif ($request->role === 'إقليم' && $user->niv == 2) $isAllowed = true;
            elseif ($request->role === 'أكاديمية' && $user->niv == 3) $isAllowed = true;

            if (!$isAllowed) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'عذراً، هذا الحساب غير مصرح له بالولوج كـ ' . $request->role,
                ])->withInput();
            }

            // 5. نجاح الدخول - تجديد الجلسة والتوجيه
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // 6. فشل تسجيل الدخول
        return back()->withErrors([
            'username' => 'البريد الإلكتروني أو القن السري غير صحيح.',
        ])->withInput($request->only('username', 'remember'));
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}