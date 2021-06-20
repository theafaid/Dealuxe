<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use Facades\Tests\Setup\ProductFactory;
use Tests\TestCase;

class ProductScopingTest extends TestCase
{

    /** @test */
    function it_can_scope_by_category()
    {
        $product = ProductFactory::create();
        ProductFactory::create();

        $product->categories()->attach(
            $category = factory(Category::class)->create()
        );

        $this->getJson(route('products.index', ['category' => $category->slug]))
            ->assertJsonFragment(['slug' => $product->slug])
            ->assertJsonCount(1, 'data');
    }
}
