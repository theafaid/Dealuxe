<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;

class AddressIndexTest extends TestCase
{
    /** @test */
    function it_fails_if_not_authenticated()
    {
        $this->getJson(route('addresses.index'))
            ->assertStatus(401);
    }

    /** @test */
    function it_shows_addresses()
    {
        $user = UserFactory::withAddress()->create();

        $this->jsonAs($user, 'GET', route('addresses.index'))
            ->assertJsonFragment(['name' => $user->addresses->random()->name]);
    }
}
