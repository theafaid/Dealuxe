<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\ShippingMethodFactory;

class CartIndexTest extends TestCase
{
    /** @test */
    function it_fails_if_unauthenticated()
    {
        $this->getJson(route('cart.index'))
            ->assertStatus(401);
    }

    /** @test */
    function it_shows_products_in_user_cart()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 2,
            $quantityForEverySingleVariation = 1
        )->create();

        $response = $this->jsonAs($user, 'GET', route('cart.index'));

        $user->fresh()->cart->each(function ($productVariation) use ($response) {
            $response->assertJsonFragment(['id' => $productVariation->id]);
        });
    }

    /** @test */
    function it_loads_meta_data_in_cart()
    {
        $user = UserFactory::putInCart($productVariationsCount = 2, $quantityForEverySingleVariation = 1)->create();

        $this->jsonAs($user, 'GET', route('cart.index'))
            ->assertJsonStructure([
                'data' => ['products'],
                'meta' => ['empty', 'subtotal', 'total', 'changed']
            ]);
    }

    /** @test */
    function it_shows_if_the_cart_is_empty()
    {
        $this->jsonAs(UserFactory::create(), 'GET', route('cart.index'))
            ->assertJsonFragment(['empty' => true]);
    }

    /** @test */
    function it_shows_a_formatted_subtotal()
    {
        $this->jsonAs(UserFactory::create(), 'GET', route('cart.index'))
            ->assertJsonFragment(['subtotal' => 'EGP 0.00']);
    }

    /** @test */
    function it_shows_a_formatted_total()
    {
        $this->jsonAs(UserFactory::create(), 'GET', route('cart.index'))
            ->assertJsonFragment(['total' => 'EGP 0.00']);
    }

    /** @test */
    function it_syncs_the_cart()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 1,
            $quantityForEverySingleVariation = 2,
            $stockCount = 0,
            [
                'price' => 1000,
            ]
        )->create();

        $this->jsonAs($user, 'GET', route('cart.index'))
            ->assertJsonFragment(['changed' => true]);
    }

    /** @test */
    function it_shows_a_formatted_total_with_shipping()
    {
        $shipping = ShippingMethodFactory::create(1, ['price' => 1000]);

        $this->jsonAs(UserFactory::create(), 'GET', route('cart.index', [
            'shipping_method_id' => $shipping->id
        ]))
            ->assertJsonFragment(['total' => 'EGP 10.00']);
    }
}
