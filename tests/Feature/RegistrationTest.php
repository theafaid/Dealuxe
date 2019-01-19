<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function a_user_must_have_a_profile_after_registration(){

       $this->post(route('register'), [
           'name' => 'John Doe',
           'email' => 'john@doe.com',
           'password' => 'password',
           'password_confirmation' => 'password'
       ]);

       $user = User::first();

       $this->assertNotNull($user->profile);
       $this->assertEquals($user->id, $user->profile->user_id);
   }
}
