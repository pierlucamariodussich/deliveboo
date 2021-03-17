<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use App\Genre;
use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {
    $restaurants = Restaurant::all();
    $genres = Genre::all();
    $names = ["carbonara","nigiri","cocacola","crostini","fanta","margherita","prosciutto e funghi","salamino","puttanesca","lasagne","bistecca alla fiorentina","ceccina","aglio e olio", "coccoli"];

    return [
        "visibility" => $faker->numberBetween(0, 1),
        'name' => $names[$faker->numberBetween(0, count($names)-1)],
        'image_url' => "https://picsum.photos/200/300?random",
        "description" => $faker->text(),
        "price"=> strval($faker->numberBetween(1,100)),
        "genre_id" =>$faker->numberBetween(1,$genres->count()),
        "restaurant_id" =>$faker->numberBetween(1,$restaurants->count()),
    ];
});
