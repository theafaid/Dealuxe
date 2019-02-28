<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponsTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function guest_cannot_add_a_coupon(){

        $coupon = create('App\Coupon', ['type' => 'fixed','value' => 20000]);

        $this->storeCoupon($coupon)->assertRedirect(route('login'));
    }

    /** @test */
    function it_require_a_valid_coupon_code_to_add_a_coupon_for_a_user(){
        $this->signIn()->generateProductThenToCart();

      $this->storeCoupon(null)
            ->assertRedirect()
            ->assertSessionHasErrors(['coupon']);
    }

    /** @test */
    function it_require_at_least_one_item_in_the_cart_to_add_a_coupon(){
        $this->signIn();
        $coupon = create('App\Coupon');

        $this->storeCoupon($coupon);

        $this->assertFalse(session()->has('coupon'));

        $this->generateProductThenToCart();

        $this->storeCoupon($coupon)
            ->assertRedirect()
            ->assertSessionHas('coupon')
            ->assertSessionHas('success');
    }


    /** @test */
    function an_authenticated_user_can_add_a_coupon(){

        $this->signIn();

        $product = create('App\Product');
        $this->toCart($product);

        $coupon = create('App\Coupon', ['type' => 'fixed','value' => 20000]);


        $this->storeCoupon($coupon)
            ->assertRedirect(route('checkout.index'))
            ->assertSessionHas('coupon')
            ->assertSessionHas('success');
    }

    /** @test */
    function an_authenticated_user_can_remove_a_coupon(){
        $this->signIn()->generateProductThenToCart();
        $coupon = create('App\Coupon');

        $this->storeCoupon($coupon);

        $this->assertTrue(session()->has('coupon'));

        $this->delete(route('coupon.remove'))
            ->assertRedirect();

        $this->assertFalse(session()->has('coupon'));

    }

    /** @test */
    function a_coupon_session_must_be_updated_after_update_the_cart(){
        $this->signIn();

        $product1 = create('App\Product', ['price' => 10000]);
        $product2 = create('App\Product', ['price' => 10000]);

        $this->toCart($product1);

        $coupon = create('App\Coupon', ['type' => 'percent', 'value' => 50]);
        $this->storeCoupon($coupon);

        $this->assertEquals(session('coupon')['discount'], 5000);

        $this->toCart($product2);

        $this->assertEquals(session('coupon')['discount'], 10000);
    }
}
