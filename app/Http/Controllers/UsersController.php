<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @OA\Get(
     *     tags={"Usuários"},
     *     path="/users",
     *     summary="Listar Usuários",
     *     description="Retorna a listagem de usuários",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="array",
     *                      @OA\Items(ref="#/components/schemas/User"),
     *                      @OA\Items(ref="#/components/schemas/User"),
     *                      @OA\Items(ref="#/components/schemas/User"),
     *                 )
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
    public function index()
    {
        return response()->success(UserResource::collection($this->usersService->loadAll()));
    }

    /**
     * @OA\Get(
     *     tags={"Usuários"},
     *     path="/users/{id}",
     *     summary="Obter Usuário",
     *     description="Retorna a usuário pelo id",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do usuário",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              minimum="1"
     *          )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/User")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Model not found!"),
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
    public function show(int $id)
    {
        return response()->success(new UserResource($this->usersService->find($id)));
    }

    /**
     * @OA\Post(
     *     tags={"Usuários"},
     *     path="/users",
     *     summary="Criar Usuário",
     *     description="Cria um novo usuário",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"username", "email", "password", "password_confirmation"},
     *                 @OA\Property(property="email", type="string", example="email@example.com.br", description="Email do usuário"),
     *                 @OA\Property(property="username", type="string", description="Username do usuário", example="gui123"),
     *                 @OA\Property(property="password", type="string", description="Senha do usuário", example="secret"),
     *                 @OA\Property(property="password_confirmation", type="string", description="Confirmação da senha do usuário", example="secret"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="Created",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/User")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="object",
     *                      @OA\Property(property="username", type="string", example="O campo username é obrigatório!"),
     *                      @OA\Property(property="email", type="string", example="O campo Email é obrigatório!"),
     *                      @OA\Property(property="password", type="string", example="O campo Senha é obrigatório!")
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
    public function store(UserRequest $request)
    {
        return response()->success($this->usersService->save($request->validated()), 201);
    }

    /**
     * @OA\Put(
     *     tags={"Usuários"},
     *     path="/users/{id}",
     *     summary="Atualizar Usuário",
     *     description="Atualiza um usuário existente",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do usuário",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              minimum="1"
     *          )
     *     ),
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"username", "email", "password", "password_confirmation"},
     *                 @OA\Property(property="email", type="string", example="email@example.com.br", description="Email do usuário"),
     *                 @OA\Property(property="username", type="string", description="Username do usuário", example="gui123"),
     *                 @OA\Property(property="password", type="string", description="Senha do usuário", example="secret"),
     *                 @OA\Property(property="password_confirmation", type="string", description="Confirmação da senha do usuário", example="secret"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="true"),
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/User")
     *             )
     *         )
     *     ),
     *
     *
     *     @OA\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="object",
     *                      @OA\Property(property="username", type="string", example="O campo username é obrigatório!"),
     *                      @OA\Property(property="email", type="string", example="O campo Email é obrigatório!"),
     *                      @OA\Property(property="password", type="string", example="O campo Senha é obrigatório!")
     *                 ),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Model not found!"),
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
    public function update(UserRequest $request, User $user)
    {
        return response()->success($this->usersService->save($request->validated(), $user));
    }

    /**
     * @OA\Delete(
     *     tags={"Usuários"},
     *     path="/users/{id}",
     *     summary="Deletar Usuário",
     *     description="Deleta um usuário existente",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do usuário",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              minimum="1"
     *          )
     *     ),
     *
     *     @OA\Response(
     *         response="204",
     *         description="No Content"
     *     ),
     *
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="string", example="Model not found!"),
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
    public function destroy(int $id)
    {
        return response()->success($this->usersService->delete($id), 204);
    }
}
