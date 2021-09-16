<?php

namespace App\Services;

use App\Models\EmployeeSalaryHistoric;

class EmployeesSalariesHistoricService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new EmployeeSalaryHistoric();
    }
}
