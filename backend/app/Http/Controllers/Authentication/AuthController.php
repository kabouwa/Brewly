<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                "success" => false,
                "message"=> "Invalid email or password.",
                "data" => null
            ], 401);

        }

        $token = $user->createToken('auth_token', expiresAt: now()->addMinutes(config('session.lifetime') ?? 21600))->plainTextToken;

        return response()->json([
            "success" => true,
            "message"=> "User logged successfully .",
            "data" => [
                'token' => $token ,
                'user' => new UserResource($user)
            ]
        ], 200);
    }

    public function user()
    {
        $user = Auth::user();

        return response()->json([
            "success" => true,
            "message"=> "Logged user retrived successfully.",
            "data" => [
                'user' => new UserResource($user)
            ]
        ], 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message"=> "User logged out successfully.",
            "data" => null
        ], 200);
    }
}
