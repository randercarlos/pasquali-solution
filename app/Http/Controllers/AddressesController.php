<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\Employee;
use App\Services\AddressesService;

class AddressesController extends Controller
{
    private $addressesService;

    public function __construct(AddressesService $addressesService) {
        $this->addressesService = $addressesService;
    }

    /**
     * @OA\Get(
     *     tags={"Endereços do Funcionário"},
     *     path="/employees/{id}/address",
     *     summary="Listar Endereços do Funcionário",
     *     description="Retorna a listagem de endereços do funcionários",
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
     *                      @OA\Items(ref="#/components/schemas/Address"),
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
        return response()->success(AddressResource::collection($this->addressesService->loadByEmployeeId($employee->id)));
    }

    /**
     * @OA\Get(
     *     tags={"Endereços do Funcionário"},
     *     path="/employees/{id}/address/{addressId}",
     *     summary="Obter Endereço do Funcionário",
     *     description="Retorna o endereço por id do funcionário",
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
     *          name="addressId",
     *          description="id do endereço",
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
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
        return response()->success(new AddressResource($this->addressesService->find($id)));
    }

    /**
     * @OA\Post(
     *     tags={"Endereços do Funcionário"},
     *     path="/employees/{id}/address",
     *     summary="Criar Endereço do Funcionário",
     *     description="Cria um novo endereço do funcionário",
     *     security={{"Authorization Header":{}}},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"place", "number", "city", "state", "postalCode", "employee_id"},
     *                 @OA\Property(property="place", type="string", example="Rua Maldonado"),
     *                 @OA\Property(property="number", type="string", example="694"),
     *                 @OA\Property(property="city", type="string", example="Dourados"),
     *                 @OA\Property(property="state", type="string", example="MT"),
     *                 @OA\Property(property="postalCode", type="string", example="67500-425"),
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
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
     *                      required={"place", "number", "city", "state", "postalCode", "employee_id"},
     *                      @OA\Property(property="place", type="string", example="O campo place é obrigatório!"),
     *                      @OA\Property(property="number", type="string", example="O campo Número é obrigatório!"),
     *                      @OA\Property(property="city", type="string", example="O campo city é obrigatório!"),
     *                      @OA\Property(property="state", type="string", example="O campo state é obrigatório!"),
     *                      @OA\Property(property="postalCode", type="string", example="O campo postal code é obrigatório!"),
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
    public function store(AddressRequest $request, Employee $employee, Address $address)
    {
        return response()->success($this->addressesService->save($request->validated()), 201);
    }


    /**
     * @OA\Put(
     *     tags={"Endereços do Funcionário"},
     *     path="/employees/{id}/address/{addressId}",
     *     summary="Atualizar Endereço do Funcionário",
     *     description="Atualiza o endereço do funcionário",
     *     security={{"Authorization Header":{}}},
     *
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
     *          name="addressId",
     *          description="id do endereço",
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
     *                 required={"place", "number", "city", "state", "postalCode", "employee_id"},
     *                 @OA\Property(property="place", type="string", example="Rua Maldonado"),
     *                 @OA\Property(property="number", type="string", example="694"),
     *                 @OA\Property(property="city", type="string", example="Dourados"),
     *                 @OA\Property(property="state", type="string", example="MT"),
     *                 @OA\Property(property="postalCode", type="string", example="67500-425"),
     *                 @OA\Property(property="employee_id", type="integer", example="2")
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
     *                 @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
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
     *                      required={"place", "number", "city", "state", "postalCode", "employee_id"},
     *                      @OA\Property(property="place", type="string", example="O campo place é obrigatório!"),
     *                      @OA\Property(property="number", type="string", example="O campo Número é obrigatório!"),
     *                      @OA\Property(property="city", type="string", example="O campo city é obrigatório!"),
     *                      @OA\Property(property="state", type="string", example="O campo state é obrigatório!"),
     *                      @OA\Property(property="postalCode", type="string", example="O campo postal code é obrigatório!"),
     *                      @OA\Property(property="employee_id", type="integer", example="O campo employee id é obrigatório!")
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
    public function update(AddressRequest $request, Employee $employee, Address $address)
    {
        return response()->success($this->addressesService->save($request->validated(), $address));
    }


    /**
     * @OA\Delete(
     *     tags={"Endereços do Funcionário"},
     *     path="/employees/{id}/address/{addressId}",
     *     summary="Deletar Endereço do Funcionário",
     *     description="Deleta um endereço do funcionário",
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
     *          name="addressId",
     *          description="id do endereço",
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
        return response()->success($this->addressesService->delete($id), 204);
    }

}
