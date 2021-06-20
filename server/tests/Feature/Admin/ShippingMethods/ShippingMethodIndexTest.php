<?php

namespace Tests\Feature\Admin\ShippingMethods;

use Tests\TestCase;

class ShippingMethodIndexTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_see_index_page()
    {
        $this->get(route('admin.shipping-methods.index'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function admin_can_see_shipping_methods_index_page()
    {
        $this->signIn()->get(route('admin.shipping-methods.index'))
            ->assertStatus(200)
            ->assertViewIs('shipping-methods.index');
    }
}
