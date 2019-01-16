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
        $category1 = create('App\Category');
        $category2 = create('App\Category');
        $product1 = create('App\Product');
        $product2 = create('App\Product');

        $this->get(route('shop.index'))
            ->assertStatus(200)
            ->assertSee($product1->name)
            ->assertSee($product2->name)
            ->assertSee($category1->name)
            ->assertSee($category2->name);
    }

    /** @test */
    function a_user_can_filter_products_by_category(){
        $category = create('App\Category');

        $product1  = create('App\Product');
        $product2  = create('App\Product');
        $product3  = create('App\Product');

        $product1->categories()->attach($category->id);
        $product2->categories()->attach($category->id);

        $this->get(route('shop.index', ['category' => $category->slug]))
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($product1->name)
            ->assertSee($product2->name)
            ->assertDontSee($product3->name);


        $product3->categories()->attach($category->id);

        $this->get(route('shop.index', ['category' => $category->slug]))
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($product1->name)
            ->assertSee($product2->name)
            ->assertSee($product3->name);

    }
}