<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Employee
 *
 * @OA\Schema(
 *     schema="Employee",
 *     title="Employee",
 *     description="Classe Funcionário",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="name", type="string", example="Alexandre da Silva"),
 *     @OA\Property(property="cpf", type="string", example="123.456-78"),
 *     @OA\Property(property="rg", type="string", example="22.289.456-7"),
 *     @OA\Property(property="birth", type="datetime", example="1981-09-16"),
 *     @OA\Property(property="email", type="string", example="teste@example.com"),
 *     @OA\Property(property="currentSalary", type="object",
 *          @OA\Property(property="salary", type="number", example="R$ 7.702,79"),
 *     ),
 *     @OA\Property(property="address", ref="#/components/schemas/Address")
 * )
 */
class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'name', 'cpf', 'rg', 'birth', 'email', 'user_id'
    ];
    protected $casts = [
        'birth' => 'date',
    ];

    public function address() {
        return $this->hasOne(Address::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function salariesHistory() {
        return $this->hasMany(EmployeeSalaryHistoric::class);
    }

    public function currentSalary() {
        return $this->hasOne(EmployeeSalaryHistoric::class)->latest();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }

}
