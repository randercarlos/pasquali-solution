<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryHistoric extends Model
{
    protected $table = 'employees_salaries_historic';
    protected $fillable = ['salary',  'employee_id'];
    protected $casts = [
        'salary' => 'float',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }

}
