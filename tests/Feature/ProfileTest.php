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
}
