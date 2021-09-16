<?php

namespace App\Services;

use App\Models\Employee;

class EmployeesService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Employee();
    }

    public function getAll() {
        return Employee::with(['user', 'currentSalary', 'address'])->get();
    }
}
