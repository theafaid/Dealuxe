<?php

namespace Tests\Feature\Admin\Dashboard;

use Facades\Tests\Setup\AdminFactory;
use Tests\TestCase;

class DashboardIndexTest extends TestCase
{
    /** @test */
    function it_fails_if_unauthenticated_user()
    {
        $this->get(route('admin.dashboard.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function authenticated_user_can_see_dashboard_index_page()
    {
        $this->signIn($admin = AdminFactory::create());

        $this->get(route('admin.dashboard.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard');
    }
}
