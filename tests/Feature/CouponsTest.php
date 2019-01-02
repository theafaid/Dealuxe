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


        $this->post(route('coupon.store'), [
            'coupon' => $coupon->code
        ])->assertRedirect(route('login'));
    }

    /** @test */
    function it_require_a_valid_coupon_code_to_add_a_coupon_for_a_user(){
        $this->signIn();
        $product = create('App\Product');
        $this->toCart($product);

        $this->post(route('coupon.store'))
            ->assertRedirect()
            ->assertSessionHasErrors(['coupon']);
    }

    /** @test */
    function it_require_at_least_one_item_in_the_cart_to_add_a_coupon(){
        $this->signIn();

        $coupon = create('App\Coupon');

        $product = create('App\Product');

        $this->post(route('coupon.store'), ['coupon' => $coupon->code])
            ->assertStatus(403);

        $this->assertFalse(session()->has('coupon'));

        $this->toCart($product);

        $this->post(route('coupon.store'), ['coupon' => $coupon->code])
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


        $this->post(route('coupon.store'), [
            'coupon' => $coupon->code
        ])
            ->assertRedirect(route('checkout.index'))
            ->assertSessionHas('coupon')
            ->assertSessionHas('success');
    }

}
