<?php

namespace Tests\Feature\Admin\Admins;

use App\Models\Admin;
use Facades\Tests\Setup\AdminFactory;
use Tests\TestCase;

class AdminUpdateTest extends TestCase
{
    /** @test */
    function un_authenticated_admin_cannot_update_an_admin()
    {
        $this->patch(route('admin.admins.update', 1))
            ->assertRedirect(route('admin.login'));
    }
//
//    /** @test */
//    function it_fails_when_invalid_admin()
//    {
//        $this->signIn()->patch(route('admin.admins.update', 1))
//            ->assertStatus(404);
//    }
//
//    /** @test */
//    function it_requires_a_name()
//    {
//        $this->endpoint()
//            ->assertSessionHasErrors(['name']);
//    }
//
//    /** @test */
//    function it_requires_an_email()
//    {
//        $this->endpoint()
//            ->assertSessionHasErrors(['email']);
//    }
//
//    /** @test */
//    function it_requires_a_unique_email()
//    {
//        $admin = AdminFactory::create();
//
//        $this->endpoint(['email' => $admin->email])
//            ->assertSessionHasErrors(['email']);
//    }
//
//    /** @test */
//    function it_requires_a_password()
//    {
//        $this->endpoint([])
//            ->assertSessionHasErrors(['password']);
//    }

//    /** @test */
//    function admin_can_update_an_admin()
//    {
//        $this->endpoint([
//            'name' => 'John Doe',
//            'email' => 'johndoe@gmail.com',
//            'password' => 'testtest'
//        ])->assertRedirect(route('admin.admins.index'));
//
//        $this->assertDatabaseHas('admins', ['name' => 'John Doe']);
//        $this->assertEquals(Admin::first()->email, 'johndoe@gmail.com');
//
//    }
    function endpoint($data = [])
    {
        $admin = AdminFactory::create();
        return $this->signIn()->patch(route('admin.admins.update', $admin->id), $data);
    }
}
