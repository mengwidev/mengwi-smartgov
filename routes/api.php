<?php

use App\Http\Controllers\Api\MobileMenuController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// login routes
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'token' => $user->createToken('mobile-app')->plainTextToken,
    ]);
});

// logout routes
Route::post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out']);
})->middleware('auth:sanctum');

// Public routes (GET requests)
Route::get('/mobilemenu', [MobileMenuController::class, 'index']);

// Protected routes (POST, PUT, PATCH, DELETE)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobilemenu', [MobileMenuController::class, 'store']);
    Route::put('/mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::patch('/mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::delete('/mobilemenu/{id}', [MobileMenuController::class, 'destroy']);
});
