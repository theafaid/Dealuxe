<?php

namespace Tests\Feature\Admin\Auth;

use Facades\Tests\Setup\AdminFactory;
use Tests\TestCase;

class LogoutTest extends TestCase
{
   /** @test */
   function it_redirect_admin_to_login_page_after_logging_out()
   {
        $this->signIn(AdminFactory::create());

        $this->get(route('admin.logout'))
            ->assertRedirect(route('admin.login'));
   }
}
