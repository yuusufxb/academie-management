<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ZProv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canViewUsers(), 403);

        $query = User::query();

        if ($auth->hasLevel(User::LEVEL_PROVINCIAL_ADMIN)) {
            $query->inSameProvinceAs($auth);
        }

        $search = $request->input('search');
        $users = $query
            ->when($search, function ($q, $search) {
                return $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('gre', 'LIKE', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function create()
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canCreateUsers(), 403);

        $provinces = ZProv::query()->orderBy('LA_PROV')->orderBy('CD_PROV')->get();

        return view('admin.user-form', compact('provinces'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canCreateUsers(), 403);

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'niv'   => 'nullable|integer|min:1|max:6',
        ];

        if ($auth->hasLevel(User::LEVEL_ACADEMY_ADMIN)) {
            $rules['gre'] = 'required_unless:niv,5|nullable|string|max:255';
            $rules['cd_prov'] = 'required_if:niv,5|nullable|string|max:15|exists:z_prov,CD_PROV';
        }

        $data = $request->validate($rules);

        if ($auth->hasLevel(User::LEVEL_PROVINCIAL_ADMIN)) {
            $data['gre'] = $auth->gre;
        } elseif ($auth->hasLevel(User::LEVEL_ACADEMY_ADMIN) && (int) ($data['niv'] ?? 0) === User::LEVEL_PROVINCIAL_ADMIN) {
            $data['gre'] = $data['cd_prov'] ?? '';
        }

        unset($data['cd_prov']);

        $plainPassword = $this->generatePassword();
        $data['password'] = Hash::make($plainPassword);

        $user = User::create($data);
        Cache::forever($this->passwordCacheKey($user->id), $plainPassword);

        return redirect()->route('admin.users')->with('success', 'تم إنشاء المستخدم. كلمة المرور المولدة: ' . $plainPassword);
    }

    public function show($id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canViewUsers(), 403);

        $user = User::findOrFail($id);
        $this->authorizeTargetUser($auth, $user);

        return view('admin.user-show', compact('user'));
    }

    public function edit($id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canEditUsers(), 403);

        $user = User::findOrFail($id);
        $this->authorizeTargetUser($auth, $user);

        $provinces = ZProv::query()->orderBy('LA_PROV')->orderBy('CD_PROV')->get();

        return view('admin.user-edit', compact('user', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canEditUsers(), 403);

        $user = User::findOrFail($id);
        $this->authorizeTargetUser($auth, $user);

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'niv'   => 'nullable|integer|min:1|max:6',
        ];

        if ($auth->hasLevel(User::LEVEL_ACADEMY_ADMIN)) {
            $rules['gre'] = 'required_unless:niv,5|nullable|string|max:255';
            $rules['cd_prov'] = 'required_if:niv,5|nullable|string|max:15|exists:z_prov,CD_PROV';
        }

        $data = $request->validate($rules);

        if ($auth->hasLevel(User::LEVEL_PROVINCIAL_ADMIN)) {
            $data['gre'] = $auth->gre;
        } elseif ($auth->hasLevel(User::LEVEL_ACADEMY_ADMIN) && (int) ($data['niv'] ?? 0) === User::LEVEL_PROVINCIAL_ADMIN) {
            $data['gre'] = $data['cd_prov'] ?? '';
        }

        unset($data['cd_prov']);

        $user->update($data);

        return redirect()->route('admin.users')
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canFullyManageUsers(), 403);

        $user = User::findOrFail($id);
        $user->delete();
        Cache::forget($this->passwordCacheKey($id));

        return redirect()->route('admin.users')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function resetPassword($id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canFullyManageUsers(), 403);

        $user = User::findOrFail($id);
        $plainPassword = $this->generatePassword();

        $user->update([
            'password' => Hash::make($plainPassword),
        ]);

        Cache::forever($this->passwordCacheKey($user->id), $plainPassword);

        return redirect()->route('admin.users')
            ->with('success', 'تمت إعادة التعيين بنجاح. كلمة المرور الجديدة للمستخدم ' . $user->email . ': ' . $plainPassword);
    }

    public function sendCredentials($id)
    {
        $auth = Auth::user();
        abort_unless($auth && $auth->canFullyManageUsers(), 403);

        $user = User::findOrFail($id);
        $plainPassword = Cache::get($this->passwordCacheKey($user->id));

        if (!$plainPassword) {
            return redirect()->route('admin.users')
                ->with('error', 'لا يمكن إرسال بيانات الدخول لأن كلمة المرور غير متاحة. قم بإعادة التعيين أولاً.');
        }

        Mail::raw(
            "مرحبا {$user->name},\n\nبيانات الدخول الخاصة بك:\nالبريد الإلكتروني: {$user->email}\nكلمة المرور: {$plainPassword}\n\nيمكنك تسجيل الدخول من الصفحة الرئيسية.",
            function ($message) use ($user) {
                $message->to($user->email)->subject('بيانات الدخول إلى المنصة');
            }
        );

        return redirect()->route('admin.users')
            ->with('success', 'تم إرسال بيانات الدخول إلى البريد الإلكتروني: ' . $user->email);
    }

    private function authorizeTargetUser(User $auth, User $target): void
    {
        if ($auth->hasLevel(User::LEVEL_PROVINCIAL_ADMIN) && ! $auth->sharesProvinceWith($target)) {
            abort(403, 'ليس لديك الصلاحية لهذا المستخدم.');
        }
    }

    private function generatePassword(int $length = 10): string
    {
        return substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%'), 0, $length);
    }

    private function passwordCacheKey(int $userId): string
    {
        return 'user_credentials_password_' . $userId;
    }
}
