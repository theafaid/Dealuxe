<?php

namespace Tests\Feature\Addresses;

use App\Models\Address;
use App\Models\User;
use Facades\Tests\Setup\AddressFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class AddressStoreTest extends TestCase
{
    /** @test */
    function it_fails_if_not_authenticated()
    {
        $this->getJson(route('addresses.store'))
            ->assertStatus(401);
    }

    /** @test */
    function it_requires_a_name()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store'))
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    function it_requires_a_city_id()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store'))
            ->assertJsonValidationErrors(['city_id']);
    }

    /** @test */
    function it_requires_an_address_1()
    {

        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store'))
            ->assertJsonValidationErrors(['address_1']);
    }

    /** @test */
    function it_requires_a_default_value()
    {

        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store'))
            ->assertJsonValidationErrors(['default']);
    }

    /** @test */
    function it_requires_an_exists_city_id()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', ['city_id' => 1]))
            ->assertJsonValidationErrors(['city_id']);
    }

    /** @test */
    function it_requires_a_supported_city()
    {
        $address = AddressFactory::inUnsupportedCity()->create();

        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', [
            'city_id' => $address->city->id
        ]))
            ->assertJsonValidationErrors(['city_id']);
    }

    /** @test */
    function it_requires_a_supported_country_for_the_city()
    {
        $address = AddressFactory::inUnsupportedCountry()->create();

        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', [
            'city_id' => $address->city->id
        ]))
            ->assertJsonValidationErrors(['city_id']);
    }

    /** @test */
    function it_requires_a_supported_country_how_ever_if_the_city_is_supported()
    {
        $address = AddressFactory::inSupportedCity()->inUnsupportedCountry()->create();

        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', [
            'city_id' => $address->city->id
        ]))
            ->assertJsonValidationErrors(['city_id']);
    }

    /** @test */
    function it_requires_a_valid_default_value()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', ['default' => 2]))
            ->assertJsonValidationErrors(['default']);
    }

    /** @test */
    function it_requires_default_to_be_numeric()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('addresses.store', ['default' => 'test']))
            ->assertJsonValidationErrors(['default']);
    }

    /** @test */
    function it_stores_an_address()
    {
        $user = UserFactory::withAddress(
            $address = AddressFactory::create()
        )->create();

        $this->jsonAs($user, 'POST', route('addresses.store', $address->toArray()));

        $this->assertDatabaseHas('addresses', ['id' => $address->id]);
    }

    /** @test */
    function it_returns_an_address_when_created()
    {
        $user = UserFactory::withAddress(
            $address = AddressFactory::create(['default' => true])
        )->create();

        $response = $this->jsonAs($user, 'POST', route('addresses.store', $address->toArray()));

        $response->assertJsonFragment([
            'name' => $address->name
        ]);
    }
}
