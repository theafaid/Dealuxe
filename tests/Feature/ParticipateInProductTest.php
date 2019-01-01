<?php

namespace Tests\Feature;

use Cart;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_see_single_product_page(){
        $product = create('App\Product');
        $this->get(route('shop.show', $product->slug))
            ->assertStatus(200)
            ->assertSee($product->name);
    }

    /** @test */
    function an_authenticated_user_must_see_the_quantity_of_his_selected_product_when_he_store_it_in_his_cart(){
        $this->signIn();

        $product = create('App\Product');

        $this->get(route('shop.show', $product->slug))
            ->assertStatus(200)
            ->assertSee(1);

        $this->assertFalse($product->inCart);

        $this->addProductToCart($product, 2);

        $this->assertTrue($product->inCart);

        $qnt = Cart::session(auth()->id())->get($product->id)->quantity;

        $this->get(route('shop.show', $product->slug))
            ->assertStatus(200)
            ->assertSee($qnt);

        $this->assertEquals(2, $qnt);
    }

    /** @test */
    function an_authenticated_user_can_update_quantity_for_a_product(){
        $this->signIn();
        $product = create('App\Product');

        $this->toCart($product);

        $user = auth()->user();

        $qnt = $user->cartItems()->first()->quantity;

        $this->assertEquals(1, $qnt);

        $this->patch(route('cart.update'), [
            'product' => $product->slug,
            'qnt' => 2
        ]);

        $qnt = $user->fresh()->cartItems()->first()->quantity;

        $this->assertEquals(2, $qnt);
    }
    /** @test */
    function a_user_must_see_might_also_like_products_in_single_product_page(){

        $product1 = create('App\Product');
        $product2 = create('App\Product');
        $product3 = create('App\Product');
        $product4 = create('App\Product');

        $this->get(route('shop.show', $product1->slug))
            ->assertSee($product2->name)
            ->assertSee($product3->name)
            ->assertSee($product4->name);
    }
}
