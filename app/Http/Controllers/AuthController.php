<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      tags={"Autenticação"},
     *      path="/auth/login",
     *      summary="Logar Usuário",
     *      description="Autentica o usuário com as credenciais informadas.",
     *
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"email", "password"},
     *                  @OA\Property(property="email", type="string", example="email@example.com.br", description="Email do usuário"),
     *                  @OA\Property(property="password", type="string", description="Senha do usuário", example="secret"),
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="success", type="boolean", example="true"),
     *                  @OA\Property(property="data", type="object",
     *                      @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MzI4NjA5NDcsImV4cCI6MTYzMjg2NDU0NywibmJmIjoxNjMyODYwOTQ3LCJqdGkiOiIzaGhCQWdKMVRJS1NFeXpkIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJk"),
     *                      @OA\Property(property="token_type", type="string", example="bearer"),
     *                      @OA\Property(property="expires_in", type="string", example="3600")
     *                  ),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Unauthenticated. It's necessary to be authenticated to access this endpoint"),
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request): JsonResponse
    {
        return response()->success($this->authService->login($request->only(['email', 'password'])));
    }

    /**
     * @OA\Get(
     *     tags={"Autenticação"},
     *     path="/auth/me",
     *     summary="Usuário Autenticado",
     *     description="Retorna os dados do usuário logado",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/User"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Unauthenticated. It's necessary to be authenticated to access this endpoint"),
     *             )
     *         )
     *     )
     * )
     */
    public function me(): JsonResponse
    {
        return response()->success($this->authService->me());
    }

    /**
     * @OA\Post(
     *     tags={"Autenticação"},
     *     path="/auth/refresh-token",
     *     summary="Atualizar Token",
     *     description="Atualiza o token do usuário logado",
     *     security={{"Authorization Header":{}}},
     *
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object",
     *                     @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MzI4NjA5NDcsImV4cCI6MTYzMjg2NDU0NywibmJmIjoxNjMyODYwOTQ3LCJqdGkiOiIzaGhCQWdKMVRJS1NFeXpkIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJk"),
     *                     @OA\Property(property="token_type", type="string", example="bearer"),
     *                     @OA\Property(property="expires_in", type="string", example="3600")
     *                 ),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Unauthenticated. It's necessary to be authenticated to access this endpoint"),
     *             )
     *         )
     *     )
     * )
     */
    public function refreshToken(): JsonResponse
    {
        return response()->success($this->authService->refreshToken());
    }

    /**
     * @OA\Post(
     *     tags={"Autenticação"},
     *     path="/auth/logout",
     *     summary="Deslogar Usuário",
     *     description="Desautentica o usuário logado",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object",
     *                     @OA\Property(property="msg", type="string", example="Successfully logged out!"),
     *                 ),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Unauthenticated. It's necessary to be authenticated to access this endpoint"),
     *             )
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        return response()->success($this->authService->logout());
    }
}
