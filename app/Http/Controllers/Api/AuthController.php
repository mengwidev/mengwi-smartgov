<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // 🔐 Login handler
    public function login(Request $request)
    {
        $data = $request->isJson() ? $request->json()->all() : $request->all();

        $validator = Validator::make($data, [
            'login' => 'required',
            'passphrase' => 'required',
            'token_name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Find user by email or username
        $user = User::where('email', $data['login'])->orWhere('username', $data['login'])->first();

        if (! $user || ! Hash::check($data['passphrase'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $tokenName = $data['token_name'] ?? 'default-client';

        $token = $user->createToken($tokenName);

        return response()->json([
            'status' => 'success',
            'token' => $token->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
            ],
        ]);
    }

    // 🚪 Logout handler
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Log out success!']);
    }
}
