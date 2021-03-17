<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use App\Restaurateur;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    static $num = 1;
    return [
        'name' => $faker->word,
        'address' => $faker->address(),
        'p_iva' => $faker->iban("IT"),
        'restaurateur_id' => $num ++,
        'image_url' => "https://picsum.photos/200/300?random",
        

    ];
});
