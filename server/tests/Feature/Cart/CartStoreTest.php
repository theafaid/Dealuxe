<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\ProductVariationFactory;

class CartStoreTest extends TestCase
{
    /** @test */
    function it_fails_if_unauthenticated()
    {
        $this->postJson(route('cart.store'))
            ->assertStatus(401);
    }

    /** @test */
    function it_requires_products()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'))
            ->assertJsonValidationErrors(['products']);
    }

    /** @test */
    function it_requires_products_to_be_an_array()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'), [
            'products' => 1
        ])
            ->assertJsonValidationErrors(['products']);
    }

    /** @test */
    function it_requires_products_to_have_an_id()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'), [
            'products' => [
                ['quantity' => 1]
            ]
        ])
            ->assertJsonValidationErrors(['products.0.id']);
    }

    /** @test */
    function it_requires_products_to_exists()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'), [
            'products' => [
                ['quantity' => 1, 'id' => 1]
            ]
        ])
            ->assertJsonValidationErrors(['products.0.id']);
    }

    /** @test */
    function it_requires_products_quantity_to_be_numeric()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'), [
            'products' => [
                ['id' => 1, 'quantity' => 'test']
            ]
        ])
            ->assertJsonValidationErrors(['products.0.quantity']);
    }

    /** @test */
    function it_requires_products_quantity_to_be_at_least_one()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('cart.store'), [
            'products' => [
                ['quantity' => 0, 'id' => 1]
            ]
        ])
            ->assertJsonValidationErrors(['products.0.quantity']);
    }

    /** @test */
    function it_can_add_products_to_authenticated_user_cart()
    {
        $productVariation = ProductVariationFactory::create();

        $this->jsonAs($user = UserFactory::create(), 'POST', route('cart.store'), [
            'products' => [
                [ 'id' => $productVariation->id, 'quantity' => 1 ]
            ]
        ])->assertStatus(201);

        $this->assertEquals($productVariation->id, $user->fresh()->cart->first()->id);

        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $productVariation->id
        ]);
    }
}
