<?php

namespace Tests\Feature\Admin\Products;

use Facades\Tests\Setup\ProductFactory;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_see_index_product_page()
    {
        $this->get(route('admin.products.show', 1))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_fails_if_invalid_product()
    {
        $this->signIn()->get(route('admin.products.show', 'invalidSlug'))
            ->assertStatus(404);
    }
    /** @test */
    function admin_can_see_a_product()
    {
        $product = ProductFactory::create();

        $this->signIn()->get(route('admin.products.show', $product->slug))
            ->assertStatus(200)
            ->assertSee($product->name)
            ->assertViewIs('products.show');
    }
}
