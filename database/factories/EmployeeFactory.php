<?php

use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'birth' => today()->subYears(Arr::random(range(20, 60))),
        'cpf' => $faker->cpf,
        'rg' => $faker->rg,
        'email' => $faker->email,
        'user_id' => $faker->unique()->numberBetween(1, 5),
    ];
});
