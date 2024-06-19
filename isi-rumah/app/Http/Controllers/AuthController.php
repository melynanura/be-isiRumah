<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Berikan respon sukses
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Fungsi Login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Buat token API
        $token = $user->createToken('auth_token')->plainTextToken;

        // Berikan respon dengan token
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // Fungsi Logout
    public function logout(Request $request)
    {
        // Hapus token saat ini
        $request->user()->currentAccessToken()->delete();

        // Berikan respon logout sukses
        return response()->json(['message' => 'Logged out successfully']);
    }

    // Fungsi untuk mendapatkan data user yang terautentikasi
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
