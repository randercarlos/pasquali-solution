<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        return response()->success($this->authService->login($request->only(['email', 'password'])));
    }

    public function logout(): JsonResponse
    {
        return response()->success($this->authService->logout());
    }

    public function refreshToken(): JsonResponse
    {
        return response()->success($this->authService->refreshToken());
    }

    public function me(): JsonResponse
    {
        return response()->success($this->authService->me());
    }


}
