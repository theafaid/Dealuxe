<?php

namespace Tests\Unit\App;

use App\App\Cart;
use App\App\Money;
use Tests\TestCase;
use Facades\Tests\Setup\ShippingMethodFactory;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\ProductVariationFactory;

class CartTest extends TestCase
{
    /** @test */
    function it_can_add_products_to_authentecation_user_cart()
    {
        $user = UserFactory::create();
        $productVariation = ProductVariationFactory::create();

        $cart = new Cart($user);

        $cart->add([
            $productVariation->id => ['quantity' => 1]
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }

    /** @test */
    function it_can_update_quantity_in_the_cart()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 1)->create();

        $cart = new Cart($user);

        $cart->update($user->cart->first()->id, 5);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 5);
    }

    /** @test */
    function it_can_delete_a_product_from_the_cart()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 1)->create();

        $cart = new Cart($user);

        $cart->delete($user->fresh()->cart->first());

        $this->assertCount(0, $user->fresh()->cart);
    }

    /** @test */
    function it_can_empty_the_cart()
    {
        $user = UserFactory::putInCart($productVariationsCount = 3, $quantityForEachProduct = 1)->create();

        $cart = new Cart($user);

        $cart->empty($user->fresh()->cart->first());

        $this->assertCount(0, $user->fresh()->cart);
    }

    /** @test */
    function it_can_check_if_cart_is_empty_of_quantities()
    {
        $user = UserFactory::putInCart($productVariationsCount = 3, $quantityForEachProduct = 0)->create();

        $cart = new Cart($user);

        $this->assertTrue($cart->isEmpty());
    }

    /** @test */
    function it_returns_a_money_instance_for_the_subtotal()
    {
        $user = UserFactory::create();

        $cart = new Cart($user);

        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }

    /** @test */
    function it_returns_correct_subtotal()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 1,
            $quantityForEachProduct = 2,
            $stockCount = 2,
            [
                'price' => 1000,
            ]
        )->create();

        $cart = new Cart($user);

        $this->assertEquals($cart->subtotal()->amount(), 2000);
    }

    /** @test */
    function it_returns_a_money_instance_for_the_total()
    {
        $user = UserFactory::create();

        $cart = new Cart($user);

        $this->assertInstanceOf(Money::class, $cart->total());
    }

    /** @test */
    function it_syncs_the_cart_to_update_quantities()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 2)->create();

        $cart = new Cart($user);

        $this->assertEquals(2, $user->fresh()->cart->first()->pivot->quantity);

        $cart->sync();

        $this->assertEquals(0, $user->fresh()->cart->first()->pivot->quantity);
    }

    /** @test */
    function it_can_check_if_cart_has_changed_after_syncing()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 2)->create();

        $cart = new Cart($user);

        $this->assertFalse($cart->hasChanged());

        $cart->sync();

        $this->assertTrue($cart->hasChanged());
    }

    /** @test */
    function it_can_return_the_correct_total_without_shipping()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 2, $stocks = 10, [
            'price' => 10000
        ])->create();

        $cart = new Cart($user);

        $this->assertEquals(20000, $cart->total()->amount());
    }

    /** @test */
    function it_can_return_the_correct_total_with_shipping()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 2, $stocks = 10, [
            'price' => 5000
        ])->create();

        $shippingMethod = ShippingMethodFactory::create(1, ['price' => 5000]);

        $cart = new Cart($user);

        $this->assertEquals(15000, $cart->withShipping($shippingMethod->id)->total()->amount());
    }
}
