<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\ProductVariationFactory;

class CartUpdateTest extends TestCase
{
    /** @test */
    function it_fails_if_unauthenticated()
    {
        $this->patchJson(route('cart.update', 1))
            ->assertStatus(401);
    }

    /** @test */
    function it_fails_if_product_cant_be_found()
    {
        $this->jsonAs(UserFactory::create(), 'PATCH', route('cart.update', 1))
            ->assertStatus(404);
    }

    /** @test */
    function it_requires_a_quantity()
    {
        $this->jsonAs(UserFactory::create(), 'PATCH', route('cart.update', ProductVariationFactory::create()->id))
            ->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    function it_requires_a_numeric_quantity()
    {
        $this->jsonAs(UserFactory::create(), 'PATCH', route('cart.update', ProductVariationFactory::create()->id), [
            'quantity' => 'test'
        ])
            ->assertJsonValidationErrors(['quantity']);
    }
    /** @test */
    function it_requires_a_quantity_of_one_or_more()
    {
        $this->jsonAs(UserFactory::create(), 'PATCH', route('cart.update', ProductVariationFactory::create()->id), [
            'quantity' => 0
        ])
            ->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    function it_updates_the_quantity_of_a_product()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 1,
            $quantityForEachProduct = 1,
            $stockCount = 20
        )->create();

        $productVariation = $user->fresh()->cart->first();

        $this->jsonAs($user, 'PATCH', route('cart.update', $productVariation->id), [
            'quantity' => 10
        ]);

        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $productVariation->id,
            'quantity' => 10
        ]);
    }
}
