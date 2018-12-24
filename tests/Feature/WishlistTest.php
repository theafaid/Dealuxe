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

  /** @test */
  function an_authenticated_user_can_clear_his_wishlist(){
      $this->signIn();
    
      $product1 = create('App\Product');
      $product2 = create('App\Product');
      $product3 = create('App\Product');
    
      $this->toSaveLater([$product1, $product2, $product3]);

      $this->assertCount(3, auth()->user()->wishlist);

      $this->post(route('wishlist.clear'))
        ->assertRedirect()
        ->assertSessionHas('success', __("front.your_wishlist_has_cleared"));

        $this->assertCount(0, auth()->user()->fresh()->wishlist);
  }

  /** @test */
  function an_authenticated_user_can_remove_an_item_from_wishlist(){
        $this->signIn();
        $user = auth()->user();
        $product1 = create('App\Product');
        $product2 = create('App\Product');
        $product3 = create('App\Product');

        $this->toSaveLater([$product1, $product2, $product3]);

        $this->assertCount(3, $user->wishlist);

        $this->delete(route('wishlist.remove'), [
            'product' => $product1->slug
        ]);

        $this->assertCount(2, $user->fresh()->wishlist);

        $this->delete(route('wishlist.remove'), [
            'product' => $product2->slug
        ]);

        $this->assertCount(1, $user->fresh()->wishlist);

        $this->assertDatabaseMissing('user_wishlist', [
            'product_id' => $product1->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseMissing('user_wishlist', [
            'product_id' => $product2->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('user_wishlist', [
            'product_id' => $product3->id,
            'user_id' => $user->id
        ]);
    }
}
