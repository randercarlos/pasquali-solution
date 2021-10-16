<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address.
 *
 * @OA\Schema(
 *     schema="Address",
 *     title="Address",
 *     description="Classe Endereço",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="place", type="string", example="Rua Maldonado"),
 *     @OA\Property(property="number", type="string", example="694"),
 *     @OA\Property(property="city", type="string", example="Dourados"),
 *     @OA\Property(property="state", type="string", example="MT"),
 *     @OA\Property(property="postalCode", type="string", example="67500-425"),
 *     @OA\Property(property="employee_id", type="integer", example="2"),
 *     @OA\Property(property="created_at", type="datetime", example="25/09/2021 23:43:47"),
 *     @OA\Property(property="updated_at", type="datetime", example="25/09/2021 23:43:47"),
 * )
 */
class Address extends Model
{
    protected $fillable = ['place', 'number', 'city', 'state', 'postalCode', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }
}
