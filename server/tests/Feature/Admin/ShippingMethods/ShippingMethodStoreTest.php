<?php

namespace Tests\Feature\Admin\ShippingMethods;

use Tests\TestCase;
use App\Models\ShippingMethod;
use Facades\Tests\Setup\CityFactory;

class ShippingMethodStoreTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_store_a_shipping_method()
    {
        $this->get(route('admin.shipping-methods.store'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_requires_a_name_and_price()
    {
        $this->endpoint()
            ->assertSessionHasErrors(['name', 'price']);
    }

    /** @test */
    function it_requires_a_cities()
    {
        $this->endpoint()
            ->assertSessionHasErrors(['cities']);
    }

    /** @test */
    function it_requires_an_array_of_cities()
    {
        $this->endpoint(['cities' => 'invalid'])
            ->assertSessionHasErrors(['cities']);
    }

    /** @test */
    function it_requires_an_array_of_cities_with_at_least_one_city()
    {
        $this->endpoint(['cities' => []])
            ->assertSessionHasErrors(['cities']);
    }

    /** @test */
    function it_requies_a_valid_city_id()
    {
        $this->endpoint(['cities' => [1]])
            ->assertSessionHasErrors(['cities.*']);
    }

    /** @test */
    function admin_can_store_a_new_shipping_method()
    {
        $this->withoutExceptionHandling();

        $this->endpoint([
            'name' => 'shipping method name',
            'price' => 10000,
            'cities' => [$city = CityFactory::create()->id]
        ])
            ->assertStatus(201);

        $shippingMethod = ShippingMethod::whereName('shipping method name')->first();

        $this->assertDatabaseHas('shipping_methods', ['id' => $shippingMethod->id]);
    }

    /** @test */
    function it_attaches_the_shipping_method_to_a_city_when_creating()
    {
        $city = CityFactory::create();

        $this->endpoint([
            'name' => 'shipping method name',
            'price' => 10000,
            'cities' => [$city->id]
        ]);

        $this->assertTrue($city->shippingMethods->pluck('id')->contains(
            ShippingMethod::first()->id
        ));
    }

    function endpoint($data = [])
    {
        return $this->signIn()->post(route('admin.shipping-methods.store'), $data);
    }
}
