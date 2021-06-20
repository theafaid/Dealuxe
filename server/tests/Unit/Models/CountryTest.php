<?php

namespace Tests\Unit\Models;

use App\Models\City;
use Tests\TestCase;
use App\Models\Country;
use App\Models\ShippingMethod;
use Illuminate\Support\Collection;
use Facades\Tests\Setup\CityFactory;

class CountryTest extends TestCase
{
    /** @test */
    function can_check_if_country_is_supported()
    {
        $city = CityFactory::create($supportedCity = true, $supportedCountry = true);

        $this->assertTrue($city->country->isSupported());
    }

    /** @test */
    function can_toggle_support_status()
    {
        $city = CityFactory::create($supportedCity = true, $supportedCountry = true);

        $country = $city->country;

        $this->assertTrue($country->isSupported());

        $country->toggleSupport();

        $this->assertFalse($country->fresh()->isSupported());
    }

    /** @test */
    function it_has_many_cities()
    {
        $city = CityFactory::create($supportedCity = true, $supportedCountry = true);

        $this->assertInstanceOf(Collection::class, $city->country->cities);
        $this->assertInstanceOf(City::class, $city->country->cities->random());

    }
}
