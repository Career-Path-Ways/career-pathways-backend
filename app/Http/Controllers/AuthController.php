<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //register user
    public function register(Request $request)
    {
        try {

            $attributes = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
                'date_of_birth' => ['required', 'date', function ($attribute, $value, $fail) {
                    $dateOfBirth = Carbon::parse($value);
                    $age = $dateOfBirth->diffInYears(Carbon::now());

                    if ($age < 18) {
                        $fail('You must be at least 18 years old to register.');
                    }
                }],
            ]);

            $attributes['password'] = bcrypt($attributes['password']);

            $user = User::create($attributes);

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            //validate fields
            $attrs = $request->validate([
                'email_username' => 'required|string|max:255',
                'password' => 'required|min:6'
            ]);

            //check if email or username
            $login_type = filter_var($request->input('email_username'), FILTER_VALIDATE_EMAIL)
                ? 'email'
                : 'username';



            // attempt login
            if (!Auth::attempt([$login_type => $attrs['email_username'], 'password' => $attrs['password']])) {
                return response([
                    'message' => 'Invalid credentials.'
                ], 403);
            }

            //return user & token in response
            return response([
                'message' => 'Welcome ' . auth()->user()->username,
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('secret')->plainTextToken
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'Logged out!'], 200);
    }
}
