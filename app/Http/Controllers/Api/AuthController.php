<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user and return token
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $token = $user->createToken('api_token')->plainTextToken;

        return (new UserResource($user))
            ->additional(['token' => $token])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Login user and return token
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'phone', 'password');

        $user = null;
        if (!empty($credentials['email'])) {
            $user = User::where('email', $credentials['email'])->first();
        } elseif (!empty($credentials['phone'])) {
            $user = User::where('phone', $credentials['phone'])->first();
        }

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return (new UserResource($user))
            ->additional(['token' => $token]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Déconnecté avec succès'
        ]);
    }

    /**
     * Refresh token
     */
    public function refresh(Request $request)
    {
        $user = $request->user();
        $request->user()->currentAccessToken()->delete();
        $token = $user->createToken('api_token')->plainTextToken;

        return (new UserResource($user))
            ->additional(['token' => $token]);
    }
}
