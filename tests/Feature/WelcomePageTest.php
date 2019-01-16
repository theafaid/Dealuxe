<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_browse_the_welcome_page(){
        $this->get(route('welcome'))
            ->assertStatus(200);
    }

    /** @test */
    function a_user_must_see_featured_or_latest_products_in_welcome_page(){
        $featuredProducts    = create('App\Product', ['featured' => true], 8);
        $notFeaturedProducts = create('App\Product', ['featured' => false], 8);

        $this->get(route('welcome'))
            ->assertSee($featuredProducts->random()->name)
            ->assertDontSee($notFeaturedProducts->random()->name);
    }
}
