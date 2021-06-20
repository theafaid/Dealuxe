<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use Facades\Tests\Setup\CategoryFactory;

class CategoryIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_categories()
    {
        $categories = CategoryFactory::create(3);

        $response = $this->getJson(route('categories.index'));

        $categories->each(function($category) use ($response) {
            $response->assertJsonFragment(['slug' => $category->slug]);
        });
    }

    /** @test */
    function it_returns_only_parents()
    {
        $category = CategoryFactory::withChild(1)->create();

        $this->getJson(route('categories.index'))
            ->assertJsonFragment(['slug' => $category->slug])
            ->assertJsonCount(1, 'data');
    }

    /** @test */
    function it_returns_children_categories_attached_to_parents()
    {
        $category = CategoryFactory::withChild(1)->create();

        $this->getJson(route('categories.index'))
            ->assertSee($category->children->random()->slug);
    }

    /** @test */
    function it_returns_only_categories_ordered_by_their_given_order()
    {
        $category = CategoryFactory::withOrder(1)->create();
        $anotherCategory = CategoryFactory::withOrder(2)->create();


        $this->getJson(route('categories.index'))
            ->assertSeeInOrder(
                ['slug' => $category->slug],
                ['slug' => $anotherCategory->slug]
            );
    }

}
