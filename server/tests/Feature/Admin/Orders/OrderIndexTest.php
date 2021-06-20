<?php

namespace Tests\Feature\Admin\Orders;

use Facades\Tests\Setup\OrderFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_see_index_orders_page()
    {
        $this->get(route('admin.orders.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function admin_can_see_orders_index_page()
    {
        $order = OrderFactory::forUser($user = UserFactory::create())->create();

        $this->signIn()->get(route('admin.orders.index'))
            ->assertStatus(200)
            ->assertViewIs('orders.index');
    }
}
