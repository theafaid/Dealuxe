<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_guest_cannot_see_profile_page(){
        $this->get(route('profile.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_can_see_his_profile(){
        $this->signIn();
        $this->get(route('profile.index'))
            ->assertStatus(200)
            ->assertViewIs('profile');
    }

    /** @test */
    function a_user_can_update_his_address_details(){
        $this->signIn();

        $addressDetails= [
            'address' => 'fake address',
            'province' => 'fake province',
            'city' => 'fake city',
            'postal_code' => '11111'
        ];

        $profile = auth()->user()->profile;

        $this->assertNull($profile->address);

        $this->patch(route('profile.address', $addressDetails))
            ->assertRedirect(route('profile.index'));

        $this->assertEquals('fake address', $profile->fresh()->address);

    }

    /** @test */
    function a_user_can_update_his_account_details(){
        $this->signIn();
        $user = auth()->user();

        $this->withoutExceptionHandling();

        $updatedUser = make('App\User', ['name' => 'john', 'password' => null]);

        $this->patch(route('profile.account', $updatedUser->toArray()))
            ->assertRedirect(route('profile.index'));

        $this->assertEquals('john', $user->fresh()->name);

        $this->assertDatabaseHas('users', ['name' => $user->fresh()->name]);
    }
}
