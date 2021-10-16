<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeSalaryHistoricRequest;
use App\Models\Employee;
use App\Models\EmployeeSalaryHistoric;
use App\Services\EmployeesSalariesHistoricService;

class EmployeesSalariesHistoricController extends Controller
{
    private $employeesSalariesHistoricService;

    public function __construct(EmployeesSalariesHistoricService $employeesSalariesHistoricService)
    {
        $this->employeesSalariesHistoricService = $employeesSalariesHistoricService;
    }

    /**
     * @OA\Get(
     *     tags={"Histórico de Salários do Funcionário"},
     *     path="/employees/{id}/salaries",
     *     summary="Listar Salários do Histórico do Funcionário",
     *     description="Retorna a listagem do histórico de salários do funcionários",
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
     *                 @OA\Property(property="data", type="array",
     *                      @OA\Items(ref="#/components/schemas/EmployeeSalaryHistoric"),
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
    public function index(Employee $employee)
    {
        return response()->success($this->employeesSalariesHistoricService->loadByEmployeeId($employee->id));
    }

    /**
     * @OA\Post(
     *     tags={"Histórico de Salários do Funcionário"},
     *     path="/employees/{id}/salaries",
     *     summary="Criar Salário no Histórico do Funcionário",
     *     description="Cria um novo salário no histórico do funcionário",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"salary", "employee_id"},
     *                 @OA\Property(property="salary", type="number", example="2344.65"),
     *                 @OA\Property(property="employee_id", type="integer", example="2")
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/EmployeeSalaryHistoric")
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
     *                      required={"salary", "employee_id"},
     *                      @OA\Property(property="salary", type="number", example="O campo salary é obrigatório!"),
     *                      @OA\Property(property="employee_id", type="integer", example="O campo employee id é obrigatório!")
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
    public function store(EmployeeSalaryHistoricRequest $request)
    {
        return response()->success($this->employeesSalariesHistoricService->save($request->validated()), 201);
    }

    /**
     * @OA\Delete(
     *     tags={"Histórico de Salários do Funcionário"},
     *     path="/employees/{id}/salaries/{salaryId}",
     *     summary="Deletar Salário do Histórico do Funcionário",
     *     description="Deleta um salário do histórico do funcionário",
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
     *     @OA\Parameter(
     *          name="salaryId",
     *          description="id do salário",
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
        return response()->success($this->employeesSalariesHistoricService->delete($id), 204);
    }
}
