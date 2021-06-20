<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Address;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Hash;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\OrderFactory;
use Facades\Tests\Setup\AddressFactory;

class UserTest extends TestCase
{
    /** @test */
    function can_fetch_the_deafult_address()
    {
        $address = AddressFactory::create(['default' => true]);

        $this->assertEquals($address->id, $address->user->defaultAddress()->id);
    }

    /** @test */
    function can_check_if_an_address_is_the_default_address_for_a_user()
    {
        $address = AddressFactory::create(['default' => true]);
        $anotherAddress = AddressFactory::create(['default' => false, 'user_id' => $address->user_id]);


        $this->assertTrue($address->user->isDefaultAddress($address));
        $this->assertFalse($address->user->isDefaultAddress($anotherAddress));
    }

    /** @test */
    function it_hashes_password_when_creating()
    {
        $user = UserFactory::create(1, ['password' => 'test']);

        $this->assertTrue(Hash::check('test', $user->password));
    }

    /** @test */
    function it_has_many_cart_products()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachVariation = 1)->create();

        $this->assertInstanceOf(ProductVariation::class, $user->cart->first());
    }

    /** @test */
    function it_has_a_quantity_pivot_for_every_single_cart_product()
    {
        $user = UserFactory::putInCart($productVariationsCount = 1, $quantityForEachVariation = 10)->create();

        $this->assertEquals(10, $user->cart->first()->pivot->quantity);
    }

    /** @test */
    function it_has_many_addresses()
    {
        $user = UserFactory::withAddress()->create();

        $this->assertInstanceOf(Address::class, $user->fresh()->addresses->first());
    }

    /** @test */
    function it_has_many_orders()
    {
        OrderFactory::forUser($user = UserFactory::create())->create();

        $this->assertInstanceOf(Order::class, $user->fresh()->orders->first());
    }
}
