<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //register user
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'skill_id' => 'required',
            'date_of_birth' => 'required|date'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }
}
