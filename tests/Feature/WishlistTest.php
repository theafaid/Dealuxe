<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_guest_cannot_add_item_in_wishlist(){
      $this->get(route('wishlist.index'))
          ->assertRedirect(route('login'));
  }

  /** @test */
  function an_authenticated_user_can_add_item_in_his_wishlist(){
      $this->signIn();

      $product = create('App\Product');

      $this->toSaveLater($product)->assertRedirect();

      $this->assertNotEmpty(auth()->user()->wishlist());
      $this->assertDatabaseHas('user_wishlist', [
          'user_id' => auth()->id(),
          'product_id' => $product->id
      ]);
  }

  /** @test */
  function cart_must_remove_product_if_user_try_to_add_product_to_save_later(){
      $this->signIn();

      $product = create('App\Product');

      $this->toCart($product);

      $this->assertCount(1, auth()->user()->cartItems());

      $this->toSaveLater($product)->assertRedirect();

      $this->assertCount(0, auth()->user()->cartItems());
  }
}
