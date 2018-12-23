<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_convert_its_price(){
        $product = create('App\Product');
        $expectedPrice = "$" . $product->price/100;
        $this->assertEquals($expectedPrice, $product->presentPrice());
    }

    /** @test */
    function it_can_fetch_might_also_like_products(){
        $product1 = create('App\Product');
        $product2 = create('App\Product');
        $product3 = create('App\Product');
        $product4 = create('App\Product');

        $mightLikeIds = $product1->mightLike()->pluck('id');

        $this->assertTrue($mightLikeIds->contains($product2->id));
        $this->assertTrue($mightLikeIds->contains($product3->id));
        $this->assertTrue($mightLikeIds->contains($product4->id));

    }
}
