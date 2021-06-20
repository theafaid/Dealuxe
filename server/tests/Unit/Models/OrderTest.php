<?php

namespace Tests\Unit\Models;

use App\App\Money;
use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Models\ShippingMethod;
use App\Models\ProductVariation;
use Illuminate\Support\Collection;
use Facades\Tests\Setup\OrderFactory;
use Facades\Tests\Setup\ShippingMethodFactory;

class OrderTest extends TestCase
{
    /** @test */
    function it_has_a_default_status_of_pending()
    {
        $this->assertEquals(OrderFactory::create()->fresh()->status,'pending');
    }

    /** @test */
    function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, OrderFactory::create()->user);
    }

    /** @test */
    function it_belongs_to_an_address()
    {
        $this->assertInstanceOf(Address::class, OrderFactory::create()->address);
    }

    /** @test */
    function it_has_many_products()
    {
        $order = OrderFactory::withProducts($count = 2, $customData = [], $qty = 1)->create();

        $this->assertInstanceOf(Collection::class, $order->products);
        $this->assertInstanceOf(ProductVariation::class, $order->products->random());
    }

    /** @test */
    function it_belongs_to_a_shipping_method()
    {
        $this->assertInstanceOf(ShippingMethod::class, OrderFactory::create()->shippingMethod);
    }


    /** @test */
    function it_has_quantity_attached_to_the_products()
    {
        $order = OrderFactory::withProducts($count = 5, [], $qty = 5)->create();

        $this->assertEquals(5, $order->products->random()->pivot->quantity);
    }

    /** @test */
    function it_returns_a_money_instance_for_subtotal()
    {
        $this->assertInstanceOf(Money::class, OrderFactory::create()->subtotal);
    }

    /** @test */
    function it_returns_a_money_instance_for_total()
    {
        $this->assertInstanceOf(Money::class, OrderFactory::create()->total());
    }

    /** @test */
    function it_add_shipping_onto_the_total()
    {

        $order = OrderFactory::create([
                'subtotal' => 5000,
                'shipping_method_id' => ShippingMethodFactory::create(1, ['price' => 5000])
            ]
        );

        $this->assertEquals(10000, $order->total()->amount());
    }
}
