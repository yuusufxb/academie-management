<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = collect([]);
        return view('admin.users', compact('users'));
    }
}
