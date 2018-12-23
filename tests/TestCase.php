<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(){
        $user = create('App\User');
        $this->actingAs($user);
        return $this;
    }
}
