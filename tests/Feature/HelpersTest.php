<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    function test_present_price_func(){
        $price = 10000;
        $this->assertEquals("$" . ($price/100), presentPrice($price));
    }

    function test_slug_from_item_func(){
        $this->signIn();

        $product = create('App\Product');

        $this->post(route('cart.store'), ['product' => $product->slug, 'qnt' => 1]);

        $userCartItem = auth()->user()->cartItems()->first();

        $this->assertEquals($product->slug, slugFromItem($userCartItem));
    }

    function test_create_new_factory_func(){
        $user = create('App\User');
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    function test_sign_in_func(){
        $this->assertFalse(auth()->check());
        $this->signIn();
        $this->assertTrue(auth()->check());
    }
}
