<?php

use Faker\Generator as Faker;

$factory->define(App\Coupon::class, function (Faker $faker) {
    return [
        'code' => str_random(7),
        'type' => 'fixed',
        'value'=> 1000 // $10
    ];
});
