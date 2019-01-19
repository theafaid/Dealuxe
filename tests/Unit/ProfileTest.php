<?php

namespace Tests\Unit;

use App\Profile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function it_belongs_to_a_user(){
      $user = create('App\User');

      $profile = Profile::create([
          'user_id' => $user->id,
          'address' => 'address data',
          'province' => 'province data',
          'city' => 'city data',
          'postal_code' => '11111',
          'phone' => '+20123456789'
      ]);

      $this->assertInstanceOf('App\User', $profile->user);
  }
}
