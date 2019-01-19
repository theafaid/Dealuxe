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
      $this->assertInstanceOf('App\User', $user->profile->user);
  }

  /** @test */
  function it_determine_if_the_profile_is_completed_or_not(){
      $user = create('App\User');

      $this->assertFalse($user->profile->isCompleted());

      $user->profile->province = "province";
      $user->profile->city = "city";
      $user->profile->address = "address";
      $user->profile->phone = "0123456789";
      $user->profile->postal_code = "11111";
      $user->profile->save();

      $this->assertTrue($user->profile->isCompleted());
  }
}
