<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_his_cart_items(){
        $product = create('App\Product');

        $this->signIn();

        $cartItems = auth()->user()->cartItems();

        $this->assertEmpty($cartItems);

        $this->toCart($product);

        $cartItems = auth()->user()->cartItems();

        $this->assertNotEmpty($cartItems);

        $this->assertEquals($cartItems->first()->name, $product->name);
    }

    /** @test */
    function can_fetch_his_cart_items_count(){
        $product = create('App\Product');

        $this->signIn();

        $cartItemsCount = auth()->user()->cartItemsCount();

        $this->assertEquals($cartItemsCount, 0);

        $this->toCart($product);

        $cartItemsCount = auth()->user()->cartItemsCount();

        $this->assertEquals($cartItemsCount, 1);
    }

    /** @test */
    function can_get_total_price_for_his_the_cart(){
        $product = create('App\Product');

        $this->signIn();

        $cartTotal= auth()->user()->cartTotal();

        $this->assertEquals("$0", $cartTotal);

        $this->toCart($product);

        $cartTotal= auth()->user()->cartTotal();

        $this->assertEquals("$".($product->price/100), $cartTotal);
    }

    /** @test */
    function it_has_many_wishlist(){
        $user = create('App\User');
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->wishlist);
    }

    /** @test */
    function can_add_a_product_to_his_wishlist(){

        $user = create('App\User');
        $product = create('App\Product');

        $user->addToWishlist($product);

        $this->assertInstanceOf('App\Product', $user->wishlist->first());

        $this->assertDatabaseHas('user_wishlist', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    /** @test */
    function an_item_cannot_be_add_to_user_wishlist_twice(){
        $user = create('App\User');
        $product = create('App\Product');

        $user->addToWishlist($product);

        $this->assertCount(1, $user->wishlist);

        $user->addToWishlist($product);

        $this->assertCount(1, $user->fresh()->wishlist);
    }
}
