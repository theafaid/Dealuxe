<?php

namespace Tests\Feature\Admin\ShippingMethods;

use Facades\Tests\Setup\CityFactory;
use Facades\Tests\Setup\ShippingMethodFactory;
use Tests\TestCase;

class ShippingMethodDestroyTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_store_a_shipping_method()
    {
        $this->get(route('admin.shipping-methods.store'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_fails_when_invalid_shipping_method()
    {
        $this->signIn()->delete(route('admin.shipping-methods.destroy', 1))
            ->assertStatus(404);
    }

    /** @test */
    function admin_can_delete_a_shipping_method()
    {
        $shippingMethod = ShippingMethodFactory::create();

        $this->signIn()->delete(route('admin.shipping-methods.destroy', $shippingMethod->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('shipping_methods', ['id' => $shippingMethod->id]);
    }

    /** @test */
    function it_detaching_the_city_after_deleting_the_shipping_method()
    {
        $shippingMethod = ShippingMethodFactory::forCity($city = CityFactory::create())->create();

        $this->assertDatabaseHas('city_shipping_method', [
            'city_id' => $city->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $this->signIn()->delete(route('admin.shipping-methods.destroy', $shippingMethod->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('shipping_methods', ['id' => $shippingMethod->id]);

        $this->assertDatabaseMissing('city_shipping_method', [
            'city_id' => $city->id,
            'shipping_method_id' => $shippingMethod->id
        ]);
    }
}


