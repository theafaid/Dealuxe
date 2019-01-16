<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_authenticated_user_cannot_see_checkout_page_if_his_cart_is_empty(){
        $this->signIn();
        $this->get(route('checkout.index'))
            ->assertRedirect(route('shop.index'));
    }
}
