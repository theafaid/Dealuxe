<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ShippingMethod::class, function (Faker $faker) {
    return [
        'name' => 'Mersal',
        'price' => 10000
    ];
});
