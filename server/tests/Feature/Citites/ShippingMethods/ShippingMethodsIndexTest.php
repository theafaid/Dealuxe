<?php

namespace Tests\Feature\Cities\ShippingMethods;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\CityFactory;
use Facades\Tests\Setup\ShippingMethodFactory;

class ShippingMethodsIndexTest extends TestCase
{
    /** @test */
    function it_fails_if_user_is_not_authenticated()
    {
        $this->getJson(route('shipping-methods.index', 1))
            ->assertStatus(401);
    }

    /** @test */
    function it_fails_if_city_cannot_be_found()
    {
        $this->jsonAs(UserFactory::create(), 'GET', route('shipping-methods.index', 1))
            ->assertStatus(404);
    }

    /** @test */
    function it_returns_shipping_method_for_given_city()
    {
        $shippingMethods = ShippingMethodFactory::forCity(
            $city = CityFactory::create()
        )->create(5);


        $response = $this->jsonAs(UserFactory::create(), 'GET', route('shipping-methods.index', $city->id));

        collect($shippingMethods)->map(function ($shippingMethod) use ($response) {
            $response->assertJsonFragment(['id' => $shippingMethod->id]);
            $response->assertJsonCount(5, 'data');
        });
    }
}
