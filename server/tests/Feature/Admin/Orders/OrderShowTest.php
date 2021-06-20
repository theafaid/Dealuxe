<?php

namespace Tests\Feature\Admin\Orders;

use Tests\TestCase;
use Facades\Tests\Setup\OrderFactory;

class OrderShowTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_show_an_order_page()
    {
        $this->get(route('admin.orders.show', 1))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_fails_if_invalid_order()
    {
        $this->signIn()->get(route('admin.orders.show', 'invalid_code'))
            ->assertStatus(404);
    }

    /** @test */
    function admin_can_see_created_orders()
    {
        $order = OrderFactory::create();

        $this->signIn()->get(route('admin.orders.show', $order->code))
            ->assertStatus(200)
            ->assertSee($order->code)
            ->assertViewIs('orders.show');
    }
}
