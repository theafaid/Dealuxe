<?php

namespace Tests\Feature\Admin\Admins;

use Tests\TestCase;

class AdminIndexTest extends TestCase
{
    /** @test */
    function un_authenticated_admin_cannot_view_admins_page()
    {
        $this->get(route('admin.admins.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function admin_can_view_admins_index_page()
    {
        $this->signIn()->get(route('admin.admins.index'))
            ->assertStatus(200)
            ->assertViewIs('admins.index');
    }
}
