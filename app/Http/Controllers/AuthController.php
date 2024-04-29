<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function getUserData(Request $request)
    {
        return response()->json([
            'message' => 'Data Success',
            'success' => true,
            'data' => [
                'user' => $request->user()
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // cek user exists atau tidak
        $user = User::where('email', $request->email)->first();

        // cek password cocok
        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return response()->json([
            'message' => 'Login Success',
            'success' => true,
            'data' => [
                'token' => $user->createToken($request->email)->plainTextToken,
                'user' => $user
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $currentUser = $request->user();
        $currentUser->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success',
            'success' => true,
            'data' => null
        ], 200);
    }

}
