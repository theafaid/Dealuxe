<?php

namespace Tests\Unit;

use App\Profile;
use Illuminate\Support\Collection;
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

        $user = auth()->user();

        $cartTotal= $user->cartTotal();

        $this->assertEquals("$0", $cartTotal);

        $this->toCart($product);

        $cartTotal= $user->cartTotal();

        $this->assertEquals("$".($product->price/100), $cartTotal);

        $cartTotal = $user->cartTotal($toDollar = false, $dollerSign = false);

        $this->assertEquals(($product->price), $cartTotal);

        $cartTotal = $user->cartTotal($toDollar = true, $dollerSign = false);

        $this->assertEquals(($product->price/100), $cartTotal);

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

    /** @test */
    function can_remove_an_item_from_his_wishlist(){
        $user = create('App\User');
    
        $product = create('App\Product');

        $user->addToWishlist($product);

        $this->assertCount(1, $user->wishlist);

        $user->removeFromWishlist($product);

        $this->assertCount(0, $user->fresh()->wishlist);
    }

    /** @test */
    function it_has_a_profile(){
        $user = create('App\User');
        $this->assertInstanceOf('App\Profile', $user->profile);
    }

    /** @test */
    function it_check_if_it_has_a_complete_profile(){
        $user = create('App\User');

        $this->assertFalse($user->hasCompletedProfile());

        $user->profile->province = "province";
        $user->profile->city = "city";
        $user->profile->address = "address";
        $user->profile->phone = "0123456789";
        $user->profile->postal_code = "11111";
        $user->profile->save();

        $this->assertTrue($user->hasCompletedProfile());
    }

    /** @test */
    function can_complete_his_profile(){
        $user = create('App\User');

        $this->assertFalse($user->hasCompletedProfile());

        $data = [
            'province' => 'province',
            'city' => 'city',
            'address' => 'adress',
            'phone' => '123456789',
            'postal_code' => '11111'
        ];

        $user->completeProfile($data);

        $this->assertTrue($user->hasCompletedProfile());

        $data = [
            'province' => 'province',
            'city' => 'city',
            'address' => null,
            'phone' => null,
            'postal_code' => null
        ];

        $user->completeProfile($data);

        $this->assertFalse($user->hasCompletedProfile(false));
    }
}
