<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect($this->redirectPathForLevel((int) Auth::user()->niv));
        }
        return view('auth.login');
    }

    /**
     * معالجة محاولة تسجيل الدخول
     */
    public function login(Request $request)
    {
        $roleLevelMap = [
            'مؤسسة' => [User::LEVEL_INSTITUTION],
            'إقليم' => [User::LEVEL_SUPERVISOR, User::LEVEL_PROVINCIAL_ADMIN],
            'أكاديمية' => [User::LEVEL_DIRECTOR, User::LEVEL_ACADEMY_ADMIN],
        ];

        // 1. التحقق من صحة المدخلات
        $request->validate([
            'username' => 'required|email', // المستخدم يدخل البريد الإلكتروني
            'password' => 'required|string',
            'role'     => 'nullable|in:مؤسسة,إقليم,أكاديمية',
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
            if ($request->filled('role') && !in_array((int) $user->niv, $roleLevelMap[$request->role], true)) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'عذراً، هذا الحساب غير مصرح له بالولوج كـ ' . $request->role,
                ])->withInput();
            }

            // 5. نجاح الدخول - تجديد الجلسة والتوجيه
            $request->session()->regenerate();
            return redirect()->intended($this->redirectPathForLevel((int) $user->niv));
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

    private function redirectPathForLevel(int $level): string
    {
        return match ($level) {
            User::LEVEL_PROVINCIAL_ADMIN => route('admin.iqlim.dashboard'),
            User::LEVEL_ACADEMY_ADMIN => route('admin.academy.dashboard'),
            default => route('admin.dashboard'),
        };
    }
}