<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use Facades\Tests\Setup\ProductFactory;

class ProductShowTest extends TestCase
{
    /** @test */
    function it_fails_if_a_product_cant_be_found()
    {
        $this->getJson(route('products.show', 'test'))
            ->assertStatus(404);
    }

    /** @test */
    function it_shows_a_products()
    {
        $product = ProductFactory::create();

        $this->getJson(route('products.show', $product->slug))
            ->assertStatus(200)
            ->assertJsonFragment(['slug' => $product->slug]);
    }
}
