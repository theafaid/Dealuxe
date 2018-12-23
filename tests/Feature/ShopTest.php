<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_browse_shop_page(){
        $this->get(route('shop.index'))
            ->assertStatus(200);
    }

    /** @test */
    function a_user_must_see_some_products_in_shop_page(){
        $product1 = create('App\Product');
        $product2 = create('App\Product');

        $this->get(route('shop.index'))
            ->assertSee($product1->name)
            ->assertSee($product2->name);
    }
}
