<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::when($request->q, fn($q,$v) => $q->where('name','like',"%$v%"))->paginate(20);
        $users = collect([]);
        return view('admin.users', compact('users'));
    }
}
