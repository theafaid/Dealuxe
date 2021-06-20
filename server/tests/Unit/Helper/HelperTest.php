<?php

namespace Tests\Unit\Helper;

use Facades\Tests\Setup\AdminFactory;
use Tests\TestCase;

class HelperTest extends TestCase
{
    /** @test */
    function can_fetch_authenticated_admin_data()
    {
        $this->assertNull(admin());

        $this->signIn($admin = AdminFactory::create());

        $this->assertEquals($admin->name, admin()->name);
    }
}
