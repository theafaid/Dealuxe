<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(){
        parent::setUp();

        if($userId = auth()->id()){
            \Cart::session($userId)->clear();
        }
    }
    /** @test */
    function a_guest_cannot_see_cart_page(){
        $this->get(route('cart.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function a_guest_cannot_store_a_product_in_cart(){
        $product = create('App\Product');

        $this->post(route('cart.index'), [
            'qnt' => 1,
            'product' => $product->slug
        ])->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_can_store_product_in_his_cart(){
        $this->signIn();

        $products = create('App\Product', [], 2);

        $this->addProductToCart($products[0])
            ->assertSessionHas('success', $products[0]->name . " " . __('front.added_to_your_cart'));

        $cartItems = auth()->user()->cartItems();

        $this->assertCount(1, $cartItems);
        $this->assertEquals(1, $cartItems->count());

        $this->addProductToCart($products[1])
            ->assertSessionHas('success', $products[1]->name . " " . __('front.added_to_your_cart'));

        $cartItems = auth()->user()->cartItems();

        $this->assertCount(2, $cartItems);
    }

    /** @test */
    function cart_is_require_a_product_to_add_a_product_in_it()
    {
        $this->signIn();
        $product = create('App\Product');
        $this->post(route('cart.store'), [])
            ->assertRedirect()
            ->assertSessionHasErrors(['product']);
    }

    /** @test */
    function an_authenticated_user_can_browse_his_cart(){
        $this->signIn();

        $products = create('App\Product', [], 4);

        $this->toCart([$products[0], $products[1]]);

        $cartItems = auth()->user()->cartItems();

        $this->assertCount(2, $cartItems);

        $this->get(route('cart.index'))
            ->assertStatus(200)
            ->assertSee($cartItems->random()->name);

        $this->toCart([$products[2], $products[3]]);

        $cartItems = auth()->user()->cartItems();

        $this->get(route('cart.index'))
            ->assertStatus(200)
            ->assertSee($cartItems->random()->name);

        $this->assertCount(4, $cartItems);
    }

    /** @test */
    function an_authenticated_user_can_clear_his_cart(){
        $this->signIn();

        $products = create('App\Product', [], 2);

        $this->toCart([$products[0], $products[1]]);

        $this->assertEquals(2, auth()->user()->cartItems()->count());

        $this->post(route('cart.clear'))
            ->assertSessionHas('success', __('front.shopping_cart_has_been_emptied'));

        $this->assertEquals(0, auth()->user()->cartItems()->count());
    }

    /** @test */
    function an_autnenticated_user_can_remove_an_item_from_his_cart(){

        $this->signIn();

       $product = create('App\Product');

        $this->toCart($product);

        $this->assertCount(1, auth()->user()->cartItems());

        $this->delete(route('cart.remove'), [
            'product' => $product->slug
        ]);

        $this->assertCount(0, auth()->user()->cartItems());
    }

    /** @test */
    function an_authenticated_user_must_have_an_alert_msg_if_his_cart_is_empty(){
        $this->signIn();
        $this->get(route('cart.index'))
            ->assertSee(__('front.your_cart_is_empty'));
    }
}
