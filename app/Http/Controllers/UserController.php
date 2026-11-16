<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    // Admin: lihat list data user
    public function index()
    {
        $users = User::with('role', 'profile')->orderBy('id')->paginate(15);

        return view('admin.users.index', compact('users'));
    }
}
