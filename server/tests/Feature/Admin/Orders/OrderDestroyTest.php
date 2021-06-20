<?php

namespace Tests\Feature\Admin\Orders;

use App\Models\Order;
use Facades\Tests\Setup\OrderFactory;
use Tests\TestCase;

class OrderDestroyTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_delete_an_order()
    {
        $this->delete(route('admin.orders.destroy', 1))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_fails_if_invalid_order()
    {
        $this->signIn()->delete(route('admin.orders.destroy', 'invalid_code'))
            ->assertStatus(404);
    }

    /** @test */
    function admin_can_delete_an_order()
    {
        $order = OrderFactory::create();

        $this->signIn()->delete(route('admin.orders.destroy', $order->code))
            ->assertStatus(204);

        $this->assertDatabaseMissing('orders', ['code' => $order->code]);
    }

}
