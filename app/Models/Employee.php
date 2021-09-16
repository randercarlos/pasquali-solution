<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
