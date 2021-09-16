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

    public function index(Employee $employee)
    {
        return response()->success(AddressResource::collection($this->addressesService->loadByEmployeeId($employee->id)));
    }

    public function show(int $id)
    {
        return response()->success(new AddressResource($this->addressesService->find($id)));
    }

    public function store(AddressRequest $request, Employee $employee, Address $address)
    {
        return response()->success($this->addressesService->save($request->validated()), 201);
    }

    public function update(AddressRequest $request, Employee $employee, Address $address)
    {
        return response()->success($this->addressesService->save($request->validated(), $address));
    }

    public function destroy(int $id)
    {
        return response()->success($this->addressesService->delete($id), 204);
    }

}
