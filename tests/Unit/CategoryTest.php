<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_products(){
        $category = create('App\Category');
        $this->assertInstanceOf(Collection::class, $category->products);
    }
}
