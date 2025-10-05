<?php

namespace App\Http\Controllers;

use App\Actions\LoginUser;
use App\Actions\RegisterUser;
use App\Actions\RevokeUserToken;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// Always try to keep the controllers as slim as possible + add the return type in each method
class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Encapsulate the token creation in the RegisterUser Action , you can return a something like this from the Action:
        // [$user,token] = (new RegisterUser())->execute($request->validated());
        $user = (new RegisterUser())->execute($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user),
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        // Same thing here encapsulate the error throw and token creation in the LoginUser Action
        $user = (new LoginUser())->execute($request->validated());

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out from all devices successfully',
        ]);
    }

    public function tokens(Request $request)
    {
        // Eventhough this is slim but using an action is better in the long run ,you might need to get all tokens of a users elsewhere
        return response()->json([
            'tokens' => $request->user()->tokens->map(function ($token) {
                return [
                    'id' => $token->id,
                    'name' => $token->name,
                    'last_used_at' => $token->last_used_at,
                    'created_at' => $token->created_at,
                ];
            }),
        ]);
    }


    public function revokeToken(Request $request, $tokenId)
    {
        // Same thing here encapsulate the error in RevokeUserToken Action
        $result = (new RevokeUserToken())->execute($request->user(), $tokenId);

        if (!$result) {
            return response()->json([
                'message' => 'Token not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Token revoked successfully',
        ]);
    }
}
