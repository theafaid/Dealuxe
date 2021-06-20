<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Database\Eloquent\Collection;

class CategoryTest extends TestCase
{

    /** @test */
    function it_has_many_children()
    {
        $category = CategoryFactory::withChild(1)->create();

        $this->assertInstanceOf(Collection::class, $category->children);
        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    /** @test */
    function can_check_if_it_is_a_parent_category()
    {
        $category = CategoryFactory::withChild(1)->create(1, true);

        $this->assertTrue($category->isParent());
        $this->assertFalse($category->children->first()->isParent());
    }

    /** @test */
    function can_fetch_parent_of_the_category()
    {
        $category = CategoryFactory::withChild(1)->create(1, true);

        $this->assertInstanceOf(Category::class, $category->children->first()->parent);
        $this->assertEquals($category->id, $category->children->first()->parent->id);
    }

    /** @test */
    function can_fetch_only_parents()
    {
        $category = CategoryFactory::withChild(2)->create();

        $parents = Category::parents();

        $this->assertEquals(1, $parents->count());

        $this->assertTrue(
            $parents->get()->contains($category)
        );

        $this->assertFalse(
            $parents->get()->contains(
                $category->children->random()
            )
        );
    }

    /** @test */
    function it_is_orderable_by_a_numbered_order()
    {
        $category = CategoryFactory::withOrder(2)->create();
        $anotherCategory = CategoryFactory::withOrder(1)->create();

        $this->assertEquals($category->id, Category::ordered('desc')->first()->id);
        $this->assertEquals($anotherCategory->id, Category::ordered('asc')->first()->id);
    }

    /** @test */
    function it_has_many_products()
    {
        $category = CategoryFactory::create();

        $category->products()->save(
            factory(Product::class)->create()
        );

        $this->assertInstanceOf(Collection::class, $category->products);
        $this->assertInstanceOf(Product::class, $category->products->random());
    }
}
