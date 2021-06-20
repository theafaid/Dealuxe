<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(\App\Models\Address::class)->create(),
        'shipping_method_id' => factory(\App\Models\ShippingMethod::class)->create(),
        'user_id' => factory(\App\Models\User::class)->create(),
        'subtotal' => 1000
    ];
});
