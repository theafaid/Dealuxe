<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;

class MeTest extends TestCase
{
    /** @test */
     function it_fails_if_user_isnot_authenticated()
    {
        $this->getJson(route('me'))
            ->assertStatus(401);
    }

    /** @test */
    function it_returns_user_details()
    {
        $user = UserFactory::create();

        $this->jsonAs($user, 'GET', route('me'))
            ->assertStatus(200)
            ->assertJsonFragment(['email' => $user->email]);
    }
}
