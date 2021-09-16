<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeesService;

class EmployeesController extends Controller
{
    private $employeesService;

    public function __construct(EmployeesService $employeesService) {
        $this->employeesService = $employeesService;
    }

    public function index()
    {
        return response()->success(EmployeeResource::collection($this->employeesService->getAll()));
    }

    public function show(int $id)
    {
        return response()->success(new EmployeeResource($this->employeesService->find($id)));
    }

    public function store(EmployeeRequest $request)
    {
        return response()->success($this->employeesService->save($request->validated()), 201);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        return response()->success($this->employeesService->save($request->validated(), $employee));
    }

    public function destroy(int $id)
    {
        return response()->success($this->employeesService->delete($id), 204);
    }

}
