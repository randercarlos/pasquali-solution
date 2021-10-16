<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeesService;

class EmployeesController extends Controller
{
    private $employeesService;

    public function __construct(EmployeesService $employeesService)
    {
        $this->employeesService = $employeesService;
    }

    /**
     * @OA\Get(
     *     tags={"Funcionários"},
     *     path="/employees",
     *     summary="Listar Funcionários",
     *     description="Retorna a listagem de funcionários",
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
     *                      @OA\Items(ref="#/components/schemas/Employee"),
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
        return response()->success(EmployeeResource::collection($this->employeesService->getAll()));
    }

    /**
     * @OA\Get(
     *     tags={"Funcionários"},
     *     path="/employees/{id}",
     *     summary="Obter Funcionário",
     *     description="Retorna o funcionário pelo id",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do funcionário",
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Employee")
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
        return response()->success(new EmployeeResource($this->employeesService->find($id)));
    }

    /**
     * @OA\Post(
     *     tags={"Funcionários"},
     *     path="/employees",
     *     summary="Criar Funcionário",
     *     description="Cria um novo funcionário",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name", "email", "cpf", "rg", "birth", "user_id"},
     *                 @OA\Property(property="name", type="string", example="Alexandre da Silva"),
     *                 @OA\Property(property="cpf", type="string", example="123.456-78"),
     *                 @OA\Property(property="rg", type="string", example="22.289.456-7"),
     *                 @OA\Property(property="birth", type="datetime", example="1981-09-16"),
     *                 @OA\Property(property="email", type="string", example="teste@example.com"),
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Employee")
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
     *                      @OA\Property(property="name", type="string", example="O campo name é obrigatório!"),
     *                      @OA\Property(property="cpf", type="string", example="O campo cpf é obrigatório!"),
     *                      @OA\Property(property="rg", type="string", example="O campo rg é obrigatório!"),
     *                      @OA\Property(property="birth", type="string", example="O campo birth é obrigatório!"),
     *                      @OA\Property(property="email", type="string", example="O campo email é obrigatório!"),
     *                      @OA\Property(property="user_id", type="string", example="O campo user_id é obrigatório!")
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
    public function store(EmployeeRequest $request)
    {
        return response()->success($this->employeesService->save($request->validated()), 201);
    }

    /**
     * @OA\Put(
     *     tags={"Funcionários"},
     *     path="/employees/{id}",
     *     summary="Atualizar Funcionário",
     *     description="Atualiza um funcionário existente",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do funcionário",
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
     *                 required={"name", "email", "cpf", "rg", "birth", "user_id"},
     *                 @OA\Property(property="name", type="string", example="Alexandre da Silva"),
     *                 @OA\Property(property="cpf", type="string", example="123.456-78"),
     *                 @OA\Property(property="rg", type="string", example="22.289.456-7"),
     *                 @OA\Property(property="birth", type="datetime", example="1981-09-16"),
     *                 @OA\Property(property="email", type="string", example="teste@example.com"),
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Employee")
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
     *
     *     @OA\Response(
     *         response="422",
     *         description="Unprocessable Entity",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="success", type="boolean", example="false"),
     *                 @OA\Property(property="msg", type="object",
     *                      @OA\Property(property="name", type="string", example="O campo name é obrigatório!"),
     *                      @OA\Property(property="cpf", type="string", example="O campo cpf é obrigatório!"),
     *                      @OA\Property(property="rg", type="string", example="O campo rg é obrigatório!"),
     *                      @OA\Property(property="birth", type="string", example="O campo birth é obrigatório!"),
     *                      @OA\Property(property="email", type="string", example="O campo email é obrigatório!"),
     *                      @OA\Property(property="user_id", type="string", example="O campo user_id é obrigatório!")
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
    public function update(EmployeeRequest $request, Employee $employee)
    {
        return response()->success($this->employeesService->save($request->validated(), $employee));
    }

    /**
     * @OA\Delete(
     *     tags={"Funcionários"},
     *     path="/employees/{id}",
     *     summary="Deletar Funcionário",
     *     description="Deleta um funcionário existente",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="id do funcionário",
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
        return response()->success($this->employeesService->delete($id), 204);
    }
}
