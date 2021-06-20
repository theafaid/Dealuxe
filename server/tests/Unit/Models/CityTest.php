<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Country;
use App\Models\ShippingMethod;
use Illuminate\Support\Collection;
use Facades\Tests\Setup\CityFactory;
use Facades\Tests\Setup\ShippingMethodFactory;

class CityTest extends TestCase
{
    /** @test */
    function it_belongs_to_a_country()
    {
        $city = CityFactory::create();

        $this->assertInstanceOf(Country::class, $city->country);
    }

    /** @test */
    function i_has_many_shipping_methods()
    {
        ShippingMethodFactory::forCity($city = CityFactory::create())->create();

        $this->assertInstanceOf(Collection::class, $city->shippingMethods);
        $this->assertInstanceOf(ShippingMethod::class, $city->shippingMethods->random());
    }

    /** @test */
    function can_check_if_city_is_supported()
    {
        $city = CityFactory::create($supported = true);

        $this->assertTrue($city->isSupported());
    }

    /** @test */
    function can_toggle_support_status()
    {
        $city = CityFactory::create($supported = true);

        $this->assertTrue($city->isSupported());

        $city->toggleSupport();

        $this->assertFalse($city->fresh()->isSupported());
    }
}
