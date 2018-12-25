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

    /** @test */
    function it_can_check_if_the_product_in_the_authenticated_user_cart(){
        $product = create('App\Product');
        $user = create('App\User');

        $this->assertFalse($product->fresh()->inCart);

        $this->actingAs($user);

        $this->assertFalse($product->inCart);

        $this->signIn();
        $this->toCart($product);

        $this->assertTrue($product->fresh()->inCart);
    }

    /** @test */
    function it_has_fans(){
        $this->signIn();
        $product = create('App\Product');

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->fans);

        $this->toSaveLater($product);

        $this->assertInstanceOf('App\User', $fan = $product->fresh()->fans->first());

        $this->assertEquals(auth()->id(), $fan->id);
    }

    /** @test */
    function it_can_check_if_the_product_in_the_authenticated_user_wishlist(){
        $product = create('App\Product');
        $user = create('App\User');

        $this->assertFalse($product->inWishlist);

        $this->actingAs($user);

        $this->assertFalse($product->fresh()->inWishlist);

        $this->signIn();
        $this->toSaveLater($product);

        $this->assertTrue($product->fresh()->inWishlist);
    }
}
