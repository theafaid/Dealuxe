<?php

namespace Tests\Feature\Orders;

use Tests\TestCase;
use App\Models\Order;
use App\Events\Order\OrderCreated;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Support\Facades\Event;
use Facades\Tests\Setup\AddressFactory;
use Facades\Tests\Setup\ShippingMethodFactory;

class OrderStoreTest extends TestCase
{
    /** @test */
    function it_fails_if_not_authenticated()
    {
        $this->postJson(route('orders.store'))
            ->assertStatus(401);
    }

    /** @test */
    function it_requires_an_address()
    {
        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store'))
            ->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    function it_requires_an_existing_address()
    {
        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store', [
            'address_id' => 1
        ]))
            ->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    function it_requires_an_existing_address_that_belongs_to_authenticated_user()
    {
        $address = AddressFactory::ownsBy(UserFactory::create())->create();

        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store', [
            'address_id' => $address->id
        ]))
            ->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    function it_requires_a_shipping_method_id()
    {
        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store'))
            ->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    function it_requires_existing_shipping_method_id()
    {

        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store', [
            'shipping_method_id' => 1
        ]))
            ->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    function it_requires_a_valid_shipping_method_valid_for_the_given_address()
    {
        $shippingMethod = ShippingMethodFactory::create();

        $this->jsonAs($this->userWithOrderDependencies(), 'POST', route('orders.store', [
            'shipping_method_id' => $shippingMethod->id
        ]))
            ->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    function it_can_create_an_order()
    {
        $user = $this->userWithOrderDependencies();

        $address = AddressFactory::ownsBy($user)->create();

        $shippingMethod = ShippingMethodFactory::forCity($address->city)->create();

        $this->jsonAs($user, 'POST', route('orders.store', [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]))
            ->assertStatus(201);


        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $this->assertEquals($user->fresh()->orders->first()->id, Order::first()->id);
    }

    /** @test */
    function it_attaches_the_products_to_the_order()
    {
        $user = $this->userWithOrderDependencies();

        $address = AddressFactory::ownsBy($user)->create();

        $shippingMethod = ShippingMethodFactory::forCity($address->city)->create();

        $response = $this->jsonAs($user, 'POST', route('orders.store', [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]))
            ->assertStatus(201);

        $this->assertDatabaseHas('product_variation_order', [
            'product_variation_id' => $user->orders->first()->products->random()->id,
            'order_id' => json_decode($response->getContent())->data->id,
            'quantity' => 1
        ]);
    }

    /** @test */
    function it_fails_to_create_order_if_cart_is_empty()
    {
        $user = UserFactory::create();

        $address = AddressFactory::ownsBy($user)->create();

        $shippingMethod = ShippingMethodFactory::forCity($address->city)->create();

        $this->jsonAs($user, 'POST', route('orders.store', [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]))->assertStatus(403);
    }

    /** @test */
    function it_fires_an_order_created_event()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $user = $this->userWithOrderDependencies();

        $address = AddressFactory::ownsBy($user)->create();

        $shippingMethod = ShippingMethodFactory::forCity($address->city)->create();

        $this->jsonAs($user, 'POST', route('orders.store', [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]));

        Event::assertDispatched(OrderCreated::class);
    }

    /** @test */
    function it_empties_the_cart_after_creating_an_order()
    {
        $user = $this->userWithOrderDependencies();

        $address = AddressFactory::ownsBy($user)->create();

        $shippingMethod = ShippingMethodFactory::forCity($address->city)->create();

         $this->jsonAs($user, 'POST', route('orders.store', [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]));

        $this->assertEmpty($user->fresh()->cart);
    }

    protected function userWithOrderDependencies()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 2,
            $quantityOfVariation = 1,
            $stockCount = 2,
            $customData = []
        )->create();

        return $user;
    }
}
