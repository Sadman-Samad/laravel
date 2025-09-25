<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginapiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token'
            ], 500);
        }
        $user = auth()->user();

        $refreshToken = bin2hex(random_bytes(32));
        $user->refresh_token = $refreshToken;
        $user->save();

        return response()->json([
            'success' => true,
            'user' => $user,
            'access_token' => $token,
            'refresh_token' => $refreshToken
        ]);
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->input('refresh_token');

        if (!$refreshToken) {
            return response()->json([
                'success' => false,
                'message' => 'Refresh token is required'
            ], 400);
        }
      
        $user = \App\Models\User::where('refresh_token', $refreshToken)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid refresh token'
            ], 401);
        }

        try {
            $newAccessToken = JWTAuth::fromUser($user);
            $newRefreshToken = bin2hex(random_bytes(32));
            $user->refresh_token = $newRefreshToken;
            $user->save();

            return response()->json([
                'success' => true,
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken 
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not refresh token'
            ], 500);
        }
    }
}
