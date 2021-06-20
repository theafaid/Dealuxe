<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\SiteSetting::class, function (Faker $faker) {
    return [
        'site_name' => $faker->name
    ];
});
