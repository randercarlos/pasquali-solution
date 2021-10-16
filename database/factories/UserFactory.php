<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->companyEmail,
        'password' => Hash::make($faker->userName),
    ];
});
