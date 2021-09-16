<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['place', 'number', 'city', 'state', 'postalCode', 'employee_id'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }
}
