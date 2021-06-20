<?php

namespace Tests\Feature\Admin\Auth;

use Tests\TestCase;
use Facades\Tests\Setup\AdminFactory;

class LoginTest extends TestCase
{
    /** @test **/
    function it_redirect_admin_to_dashboard_index_page_if_credentials_is_valid()
    {
        $admin = AdminFactory::create();
        $this->post(route('admin.login'), [
            'email' => $admin->email,
            'password' => 'password',
        ])
            ->assertRedirect(route('admin.dashboard.index'));

        $this->assertNotNull(admin());
    }
}
