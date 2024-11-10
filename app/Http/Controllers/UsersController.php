<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class UsersController extends Controller{
    

    // Register a new user
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    // Login user and create token
    public function login(Request $request){
        $request->validate([
            'name' => 'required|string|',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('name', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = Auth::user();
        return response()->json([
            'message' => 'Successfully logged in',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user
        ]);
    }

    // Logout user and revoke token
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Get authenticated user
    public function user(Request $request){
        return response()->json($request->user());
    }

}
