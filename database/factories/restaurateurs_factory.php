<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurateur;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Restaurateur::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('ciao'),
        
    ];
});
