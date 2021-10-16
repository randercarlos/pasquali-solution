<?php

use App\Models\EmployeeSalaryHistoric;
use Faker\Generator as Faker;

$factory->define(EmployeeSalaryHistoric::class, function (Faker $faker) {
    return [
        'salary' => $faker->randomFloat(2, $min = 1000, $max = 20000),
        'employee_id' => $faker->numberBetween(1, 5),
    ];
});
