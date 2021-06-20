<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\City;
use Facades\Tests\Setup\AddressFactory;

class AddressTest extends TestCase
{
   /** @test */
   function it_belongs_to_a_city()
   {
       $address = AddressFactory::create();

       $this->assertInstanceOf(City::class, $address->city);
   }

    /** @test */
    function it_belongs_to_a_user()
    {
        $address = AddressFactory::create();

        $this->assertInstanceOf(User::class, $address->user);
    }

    /** @test */
    function can_check_if_the_address_is_default()
    {
        $address = AddressFactory::create(['default' => true]);

        $this->assertTrue($address->isDefault());
    }


    /** @test */
    function it_can_toggle_default_address()
    {
        $address = AddressFactory::create(['default' => true]);

        $address->toggleDefault($address);

        $this->assertFalse($address->isDefault());
    }

    /** @test */
    function it_sets_old_addresses_to_not_default_when_creating_a_default_address()
    {
        $address = AddressFactory::create(['default' => true]);

        $newAddress = AddressFactory::create(['default' => true, 'user_id' => $address->user_id]);

        $this->assertTrue($newAddress->isDefault());

        $this->assertFalse($address->fresh()->isDefault());
    }
}
