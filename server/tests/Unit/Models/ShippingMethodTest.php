<?php

namespace Tests\Unit\Models;

use App\App\Money;
use App\Models\City;
use Facades\Tests\Setup\CityFactory;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Facades\Tests\Setup\ShippingMethodFactory;

class ShippingMethodTest extends TestCase
{
    /** @test */
    function it_returns_a_money_instance_for_the_price()
    {
        $this->assertInstanceOf(Money::class, ShippingMethodFactory::create()->price);
    }

    /** @test */
    function it_returns_a_formatted_price()
    {
        $shipping =  ShippingMethodFactory::create(1, ['price' => 10000]);

        $this->assertEquals('EGP 100.00', $shipping->formattedPrice);
    }

    /** @test */
    function it_belongs_to_many_countries()
    {
        $shippingMethod =  ShippingMethodFactory::forCity(CityFactory::create())->create();

        $this->assertInstanceOf(City::class, $shippingMethod->cities->random());
        $this->assertInstanceOf(Collection::class, $shippingMethod->cities);
    }

}
