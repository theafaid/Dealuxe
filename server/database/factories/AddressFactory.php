<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory(\App\Models\User::class)->create(),
        'address_1' => $faker->streetAddress,
        'city_id' => factory(\App\Models\City::class)->create(),
        'postal_code' => $faker->postcode,
    ];
});
