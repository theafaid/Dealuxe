<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;

class CartDestroyTest extends TestCase
{
    /** @test */
    function it_fails_if_unauthenticated()
    {
        $this->deleteJson(route('cart.destroy', 1))
            ->assertStatus(401);
    }

        /** @test */
        function it_fails_if_product_cant_be_found()
        {
            $this->jsonAs(UserFactory::create(), 'DELETE', route('cart.destroy', 1))
                ->assertStatus(404);
        }

    /** @test */
    function it_deletes_product_from_cart()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachProduct = 1)->create();

        $this->jsonAs($user, 'DELETE', route('cart.destroy', $productId = $user->fresh()->cart->first()->id));

        $this->assertDatabaseMissing('cart_user', [
            'product_variation_id' => $productId
        ]);
    }
}
