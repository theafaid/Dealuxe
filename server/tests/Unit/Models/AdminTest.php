<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Facades\Tests\Setup\AdminFactory;

class AdminTest extends TestCase
{
    /** @test */
    function it_hashes_password_when_creating()
    {
        $user = AdminFactory::create(1, ['password' => 'test']);

        $this->assertTrue(Hash::check('test', $user->password));
    }
}
