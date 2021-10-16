<?php

namespace App\Services;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService
{
    public function login($credentials)
    {
        if (! $token = auth()->attempt($credentials)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return ['msg' => 'Successfully logged out!'];
    }

    public function refreshToken()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me(): Authenticatable
    {
        return auth()->user();
    }

    private function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }
}
