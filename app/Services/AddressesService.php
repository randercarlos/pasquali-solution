<?php

namespace App\Services;

use App\Models\Address;

class AddressesService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Address();
    }

    public function loadByEmployeeId($employeeId) {
        return Address::where('employee_id', $employeeId)->get();
    }
}
