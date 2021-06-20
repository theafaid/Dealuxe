<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Stock::class, function (Faker $faker) {
    return [
        'product_variation_id' => factory(\App\Models\ProductVariation::class)->create(),
        'quantity' => $faker->numberBetween(1, 1000),
    ];
});
