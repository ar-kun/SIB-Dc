<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        request()->validate([
            'name' => 'required|string|min:3',
            'username' => 'required|alpha_num|min:3|max:25|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        return response()->json([
            'message' => 'User created successfully',
        ], 201);
    }
}