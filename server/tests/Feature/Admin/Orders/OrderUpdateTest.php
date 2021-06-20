<?php

namespace Tests\Feature\Admin\Orders;

use App\Models\Order;
use Facades\Tests\Setup\OrderFactory;
use Tests\TestCase;

class OrderUpdateTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_update_an_order()
    {
        $this->patch(route('admin.orders.update', 1))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_fails_if_invalid_order()
    {
        $this->signIn()->patch(route('admin.orders.update', 'invalid_code'))
            ->assertStatus(404);
    }

    /** @test */
    function it_requires_a_status()
    {
        $this->endpoint()
            ->assertSessionHasErrors(['status']);
    }

    function it_requires_a_valid_status()
    {
        $this->endpoint(['status' => 'test'])
            ->assertSessionHasErrors(['status']);
    }

    /** @test */
    function admin_can_update_an_order()
    {
        $this->endpoint(['status' => 'delivering'])
            ->assertStatus(200);

        $this->assertEquals('delivering', Order::first()->status);
    }

    function endpoint($data = [])
    {
        $order = OrderFactory::create();
        return $this->signIn()->patch(route('admin.orders.update', $order->code), $data);
    }
}
