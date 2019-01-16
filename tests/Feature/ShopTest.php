<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_browse_shop_page(){
        $products = create('App\Product', [], 2);
        $this->get(route('shop.index'))
            ->assertStatus(200)
            ->assertSee($products->random()->name);
    }

    /** @test */
    function a_user_must_see_some_products_in_shop_page_and_must_see_all_categories(){
        $categories = create('App\Category', [], 2);
        $products   = create('App\Product', [], 2);

        $this->get(route('shop.index'))
            ->assertStatus(200)
            ->assertSee($products[0]->name)
            ->assertSee($products[1]->name)
            ->assertSee($categories[0]->name)
            ->assertSee($categories[1]->name);
    }

    /** @test */
    function a_user_can_filter_products_by_category(){
        $category = create('App\Category');
        $products   = create('App\Product', [], 3);

        $products[0]->categories()->attach($category->id);
        $products[1]->categories()->attach($category->id);

        $this->get(route('shop.index', ['category' => $category->slug]))
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($products[0]->name)
            ->assertSee($products[1]->name)
            ->assertDontSee($products[2]->name);


        $products[2]->categories()->attach($category->id);

        $this->get(route('shop.index', ['category' => $category->slug]))
            ->assertStatus(200)
            ->assertSee($products[2]->name);

    }
}