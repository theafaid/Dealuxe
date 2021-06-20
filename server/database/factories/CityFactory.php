<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'district' => $faker->streetName,
        'country_id' => factory(\App\Models\Country::class)->create(),
        'supported' => true,
    ];
});
