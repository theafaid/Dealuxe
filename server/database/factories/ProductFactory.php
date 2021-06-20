<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->sentence,
        'slug' => \Str::slug($name),
        'description' => $faker->paragraph(25),
        'price' => $faker->numberBetween(10000, 500000)
    ];
});
