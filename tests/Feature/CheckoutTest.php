<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_guest_cannot_view_checkout_page(){
        $this->get(route('checkout.index'))
            ->assertRedirect(route('login'));
    }
    /** @test */
    function an_authenticated_user_cannot_see_checkout_page_and_will_redirected_to_shop_page_if_his_cart_is_empty(){
        $this->signIn($completeProfile = true); // his profile is completed and his cart is empty
        $this->get(route('checkout.index'))
            ->assertRedirect(route('shop.index'));
    }

    /** @test */
    function an_authenticated_user_cannot_see_checkout_page_and_will_redirected_to_profile_page_if_his_profile_not_completed(){
        $this->signIn($completeProfile = false); // his profile not completed

        $this->generateProductThenToCart(); // his cart not empty

        $this->get(route('checkout.index'))
            ->assertSessionHas('error')
            ->assertRedirect(route('profile.index'));
    }
}
