<?php

namespace Tests\Feature\Admin\Categories;

use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /** @test */
    function unauthenticated_user_cannot_see_categories_page()
    {
        $this->get(route('admin.categories.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function authenticated_admin_can_see_categories_page()
    {
        $this->signIn()->get(route('admin.categories.index'))
            ->assertStatus(200)
            ->assertViewIs('categories.index');
    }
}
