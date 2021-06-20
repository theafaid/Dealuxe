<?php

namespace Tests\Unit\Products;

use Tests\TestCase;
use App\App\Money;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Collection;
use App\Models\ProductVariationType;
use Facades\Tests\Setup\ProductFactory;
use Facades\Tests\Setup\ProductVariationFactory;

class ProductVariationTest extends TestCase
{
    /** @test */
    function it_has_one_variation_type()
    {
        $variation = ProductVariationFactory::create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    /** @test */
    function it_belongs_to_a_product()
    {
        $variation = ProductVariationFactory::create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }

    /** @test */
    function it_returns_a_money_instance_for_the_price()
    {
        $variation = ProductVariationFactory::create();

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    /** @test */
    function it_returns_formatted_price()
    {
        $variation = ProductVariationFactory::create(1, ['price' => '1000']);

        $this->assertEquals('EGP 10.00', $variation->formattedPrice);
    }

    /** @test */
    function it_returns_parent_price_if_price_is_nullable()
    {
        $product = ProductFactory::withVariations(1, ['price' => null])->create(1, ['price' => '1000']);

        $this->assertEquals($product->price->amount(), $product->variations->first()->price->amount());
    }

    /** @test */
    function it_can_check_if_the_variation_price_is_different_to_the_product()
    {
        $product1 = ProductFactory::withVariations(1, ['price' => '10'])->create(1, ['price' => '1000']);
        $product2 = ProductFactory::withVariations(1, ['price' => '10'])->create(1, ['price' => '10']);

        $this->assertTrue($product1->variations->first()->priceVaries());
        $this->assertFalse($product2->variations->first()->priceVaries());
    }

    /** @test */
    function it_has_many_stocks()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)->create();

        $this->assertInstanceOf(Stock::class, $productVariation->stocks->first());
    }

    /** @test */
    function it_has_stock_information()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)->create();

        $this->assertInstanceOf(Collection::class, $productVariation->stock);
        $this->assertInstanceOf(ProductVariation::class, $productVariation->stock->first());
    }

    /** @test */
    function it_has_stock_count_pivot_with_stock_information()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)->create();

        $this->assertEquals($qnt, $productVariation->stock->first()->pivot->stock);
    }

    /** @test */
    function it_has_in_stock_pivot_within_stock_information()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)->create();

        $this->assertTrue(!! $productVariation->stock->first()->pivot->in_stock);
    }

    /** @test */
    function it_can_check_if_its_in_stock()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)->create();

        $this->assertTrue($productVariation->inStock());
        $this->assertEquals(5, $productVariation->stockCount());
    }

    /** @test */
    function it_can_get_stock_count()
    {
        $productVariation = ProductVariationFactory::withStocks($qnt = 5)
            ->addAdditionalStocks(5)->create();

        $this->assertEquals(10, $productVariation->stockCount());
    }

    /** @test */
    function it_can_get_minimum_stock_for_a_given_values()
    {
        $productVariation1 = ProductVariationFactory::withStocks($qnt1 = 5)->create();
        $productVariation2 = ProductVariationFactory::withStocks($qnt2 = 5)->create();

        $this->assertEquals($qnt1, $productVariation1->minStock(rand(6, 1000)));
        $this->assertEquals(4, $productVariation2->minStock(4));
    }
}
