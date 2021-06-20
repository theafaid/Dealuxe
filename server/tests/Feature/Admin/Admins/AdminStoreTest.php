<?php

namespace Tests\Feature\Admin\Admins;

use Tests\TestCase;
use Facades\Tests\Setup\AdminFactory;

class AdminStoreTest extends TestCase
{
    /** @test */
    function un_authenticated_admin_cannot_add_an_admin()
    {
        $this->get(route('admin.admins.store'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_requires_a_name()
    {
        $this->endpoint()
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    function it_requires_an_email()
    {
        $this->endpoint()
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function it_requires_a_unique_email()
    {
        $admin = AdminFactory::create();

        $this->endpoint(['email' => $admin->email])
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function it_requires_a_password()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['password']);
    }

    /** @test */
    function admin_can_add_a_new_admin()
    {
        $this->endpoint([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'testtest'
        ])->assertRedirect(route('admin.admins.index'));

        $this->assertDatabaseHas('admins', ['name' => 'John Doe']);

    }
    function endpoint($data = [])
    {
        return $this->signIn()->post(route('admin.admins.store'), $data);
    }
}
