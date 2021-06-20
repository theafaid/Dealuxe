<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ProductVariation::class, function (Faker $faker) {
    return [
        'product_id' => factory(\App\Models\Product::class)->create(),
        'name' => $faker->unique()->name,
        'product_variation_type_id' => factory(\App\Models\ProductVariationType::class)->create(),
    ];
});
