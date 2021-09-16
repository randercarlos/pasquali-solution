<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeSalaryHistoricRequest;
use App\Models\Employee;
use App\Models\EmployeeSalaryHistoric;
use App\Services\EmployeesSalariesHistoricService;

class EmployeesSalariesHistoricController extends Controller
{
    private $employeesSalariesHistoricService;

    public function __construct(EmployeesSalariesHistoricService $employeesSalariesHistoricService) {
        $this->employeesSalariesHistoricService = $employeesSalariesHistoricService;
    }

    public function index(Employee $employee)
    {
        return response()->success($this->employeesSalariesHistoricService->loadByEmployeeId($employee->id));
    }

    public function show(int $id)
    {
        return response()->success($this->employeesSalariesHistoricService->find($id));
    }

    public function store(EmployeeSalaryHistoricRequest $request)
    {
        return response()->success($this->employeesSalariesHistoricService->save($request->validated()), 201);
    }

    public function update(EmployeeSalaryHistoricRequest $request, EmployeeSalaryHistoric $employeeSalaryHistoric)
    {
        return response()->success($this->employeesSalariesHistoricService->save($request->validated(), $employeeSalaryHistoric));
    }

    public function destroy(int $id)
    {
        return response()->success($this->employeesSalariesHistoricService->delete($id), 204);
    }

}
