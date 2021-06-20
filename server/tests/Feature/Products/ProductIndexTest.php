<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use Facades\Tests\Setup\ProductFactory;

class ProductIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_products()
    {
        $products = ProductFactory::create(2);

        $response = $this->getJson(route('products.index'));

        $products->each(function ($product) use ($response) {
            $response->assertJsonFragment(['slug' => $product->slug]);
        });

        $response->assertJsonCount(2, 'data');
    }

    /** @test */
    function it_has_paginated_data()
    {
        $this->getJson(route('products.index'))
            ->assertJsonStructure([
                'meta', 'links', 'data'
            ]);
    }
}
