<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_browse_the_welcome_page(){
        $this->get(route('welcome'))
            ->assertStatus(200);
    }

    /** @test */
    function a_user_must_see_some_products_in_welcome_page(){
        $product = factory('App\Product')->create();

        $this->get(route('welcome'))
            ->assertSee($product->name);
    }
}
