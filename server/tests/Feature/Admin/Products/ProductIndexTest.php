<?php

namespace Tests\Feature\Admin\Products;

use Facades\Tests\Setup\ProductFactory;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_see_index_product_page()
    {
        $this->get(route('admin.products.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function admin_can_see_index_product_page()
    {
        $products = ProductFactory::create(3);

        $this->signIn()->get(route('admin.products.index'))
            ->assertStatus(200)
            ->assertViewIs('products.index')
            ->assertSee($products->random()->name);
    }
}
