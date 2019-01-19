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
}
