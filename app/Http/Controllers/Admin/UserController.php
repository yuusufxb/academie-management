<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index(Request $request)
{
    // جلب كلمة البحث من الإدخال
    $search = $request->input('search');

    // إنشاء استعلام يبحث في الاسم أو البريد الإلكتروني
    $users = User::when($search, function ($query, $search) {
        return $query->where('name', 'LIKE', "%{$search}%")
                     ->orWhere('email', 'LIKE', "%{$search}%")
                     ->orWhere('gre', 'LIKE', "%{$search}%");
    })
    ->latest('id')
    ->paginate(10);

    return view('admin.users', compact('users'));
}

    public function create()
    {
        return view('admin.user-form');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'niv'      => 'nullable|integer', // استقبال حقل المستوى
        'gre'      => 'nullable|string',  // استقبال حقل رمز المؤسسة
    ]);

    // تشفير كلمة المرور
    $data['password'] = Hash::make($data['password']);

    // إنشاء المستخدم مع كل البيانات
    User::create($data); 

    return redirect()->route('admin.users')->with('success', 'تم إنشاء المستخدم');
}

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user-show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => "required|email|unique:users,email,$id",
        'niv'   => 'nullable|integer|min:1|max:3', // تحديث الاسم هنا
        'gre'   => 'nullable|string|max:255',  // تحديث الاسم هنا
    ]);

    $user->update($data);

    return redirect()->route('admin.users')
        ->with('success', 'تم تحديث بيانات المستخدم بنجاح');
}

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users')
        ->with('success', 'تم حذف المستخدم بنجاح');
}
}