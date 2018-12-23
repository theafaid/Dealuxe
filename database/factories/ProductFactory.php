<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $name=  $faker->text;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'price' => $faker->numberBetween(1000, 2000),
        'description' => $faker->paragraph,
        'details' => $faker->paragraph
    ];
});
