<?php

namespace Tests\Unit\Models;

use App\App\Money;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariation;
use Illuminate\Support\Collection;
use Facades\Tests\Setup\ProductFactory;
use Facades\Tests\Setup\ProductVariationFactory;

class ProductTest extends TestCase
{
    /** @test */
    function it_uses_slug_for_route_key_name()
    {
        $product = new Product();

        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    /** @test */
    function it_returns_a_default_product_image_if_main_image_is_nullable()
    {
        $product = new Product();

        $this->assertEquals(url('design/admin/img/default_product.png'), $product->main_image);
    }

    /** @test */
    function it_returns_product_main_image_if_not_nullable()
    {
        $product = ProductFactory::create(null, [
            'main_image' => 'test.jpg'
        ]);

        $this->assertEquals(url('storage/test.jpg'), $product->main_image);
    }

    /** @test */
    function it_has_many_categories()
    {
        $product = ProductFactory::create();

        $product->categories()->attach(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Collection::class, $product->categories);
        $this->assertInstanceOf(Category::class, $product->categories->first());
    }

    /** @test */
    function it_has_many_variations()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(
            factory(ProductVariation::class)->make()
        );

        $this->assertInstanceOf(Collection::class, $product->variations);
        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());
    }

    /** @test */
    function it_returns_a_money_instance_for_the_price()
    {
        $product = ProductFactory::create();

        $this->assertInstanceOf(Money::class, $product->price);
    }

    /** @test */
    function it_returns_formatted_price()
    {
        $product = ProductFactory::create(1, ['price' => '1000']);

        $this->assertEquals('EGP 10.00', $product->formattedPrice);
    }

    /** @test */
    function it_can_check_if_its_in_stock()
    {
        $productVaration = ProductVariationFactory::withStocks(1)->create();

        $this->assertTrue($productVaration->product->inStock());
    }

    /** @test */
    function it_can_get_the_stock_count()
    {
        $productVaration = ProductVariationFactory::withStocks(5)->create();

        $this->assertEquals(5, $productVaration->product->stockCount());
    }
}
