<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Facades\Tests\Setup\UserFactory;

class RegistrationTest extends TestCase
{
    /** @test */
    function it_requires_a_name_and_email_and_password()
    {
        $this->postJson(route('register'), [])
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /** @test */
    function it_requires_a_valid_email()
    {
        $this->postJson(route('register'), ['email' => 'test'])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_requires_a_unique_email()
    {
        $user = UserFactory::create();

        $this->postJson(route('register'), ['email' => $user->email])
            ->assertJsonValidationErrors(['email']);
    }


    /** @test */
    function it_can_register_a_user()
    {
        $response = $this->postJson(route('register'), [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest'
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'Test']);

        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
    }
}
