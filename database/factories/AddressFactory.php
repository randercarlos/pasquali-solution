<?php

use App\Models\Address;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Address::class, function (Faker $faker) {
    static $i = 1;

    return [
        'place' => $faker->streetName,
        'number' => Arr::random(range(1, 1000)),
        'city' =>  $faker->city,
        'state' =>  $faker->stateAbbr,
        'postalCode' => $faker->postcode,
        'employee_id' => $i++
    ];
});
