<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user
    Route::get('/user', [UserController::class, 'show']);
    // Update user profile
    Route::put('/user', [UserController::class, 'update']);
    // Change password
    Route::put('/password', [UserController::class, 'changePassword']);
    // Delete account
    Route::delete('/user', [UserController::class, 'destroy']);

    // Get user tokens
    Route::get('/tokens', [AuthController::class, 'tokens']);
    // Logout (revoke current token)
    Route::post('/logout', [AuthController::class, 'logout']);
    // Logout from all devices (revoke all tokens)
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    // Revoke specific token
    Route::delete('/tokens/{tokenId}', [AuthController::class, 'revokeToken']);
});
