<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_see_single_product_page(){
        $product = factory('App\Product')->create();

        $this->get(route('shop.show', $product->slug))
            ->assertStatus(200)
            ->assertSee($product->name);
    }

    /** @test */
    function a_user_must_see_might_also_like_products_in_single_product_page(){

        $product1 = factory('App\Product')->create();
        $product2 = factory('App\Product')->create();
        $product3 = factory('App\Product')->create();
        $product4 = factory('App\Product')->create();

        $this->get(route('shop.show', $product1->slug))
            ->assertSee($product2->name)
            ->assertSee($product3->name)
            ->assertSee($product4->name);
    }
}
