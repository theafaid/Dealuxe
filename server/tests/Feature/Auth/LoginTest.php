<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;

class LoginTest extends TestCase
{
    /** @test */
    function it_requires_an_email_and_a_password()
    {
        $this->postJson(route('login'), [])
            ->assertJsonValidationErrors(['email', 'password']);
    }

    /** @test */
    function it_requires_a_valid_email()
    {
        $this->postJson(route('login'), ['email' => 'test'])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_returns_a_validation_errors_if_credentials_are_invalid()
    {
        $user = UserFactory::create();

        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'testtest'
        ])->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_returns_a_token_with_user_if_credentials_are_valid()
    {
        $user = UserFactory::create(1, ['password' => 'testtest']);

        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'testtest'
        ])
            ->assertStatus(200)
            ->assertJsonStructure(['data', 'meta' => ['token']])
            ->assertJsonFragment(['email' => $user->email]);
    }
}
