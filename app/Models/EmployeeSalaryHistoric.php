<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeSalaryHistoric
 *
 * @OA\Schema(
 *     schema="EmployeeSalaryHistoric",
 *     title="EmployeeSalaryHistoric",
 *     description="Classe Histórico de Salários do Funcionário",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="salary", type="number", example="4834.45"),
 *     @OA\Property(property="employee_id", type="integer", example="2"),
 *     @OA\Property(property="created_at", type="datetime", example="25/09/2021 23:43:47"),
 *     @OA\Property(property="updated_at", type="datetime", example="25/09/2021 23:43:47"),
 * )
 */
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
