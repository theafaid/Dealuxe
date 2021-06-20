<?php

namespace Tests\Setup;

use App\Models\Country;

class CountryFactory
{

    public function create($count = 1, $supported = true)
    {
        $country = factory(Country::class, $count > 1 ? $count : null)->create(['supported' => $supported]);

        return $country;
    }
}
