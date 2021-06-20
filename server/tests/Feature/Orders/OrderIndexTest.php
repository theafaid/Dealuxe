<?php

namespace Tests\Feature\Orders;

use Facades\Tests\Setup\OrderFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    /** @test */
    function it_fails_if_user_not_authenticated()
    {
        $this->getJson(route('orders.index'))
            ->assertStatus(401);
    }

    /** @test */
    function it_returns_a_collection_of_orders()
    {
        $order = OrderFactory::forUser($user = UserFactory::create())->create();

        $this->jsonAs($user, 'GET', route('orders.index'))
            ->assertJsonFragment(['id' => $order->id]);
    }

    /** @test */
    function it_orders_by_the_latest()
    {
        $order = OrderFactory::forUser($user = UserFactory::create())->create();
        $anotherOrder = OrderFactory::forUser($user)->create(['created_at' => now()->subDays(2)]);

        $this->jsonAs($user, 'GET', route('orders.index'))
            ->assertSeeInOrder([ $order->created_at, $anotherOrder->created_at]);
    }

    /** @test */
    function it_loads_paginated_data()
    {
        $this->jsonAs(UserFactory::create(), 'GET', route('orders.index'))
            ->assertJsonStructure(['data', 'links', 'meta']);
    }
}
