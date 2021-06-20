<?php

namespace Tests\Feature\Admin\Categories;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Support\Facades\Storage;

class CategoryStoreTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_store_a_category()
    {
        $category = CategoryFactory::make();

        $this->postJson(route('admin.categories.store'), $category->toArray())
            ->assertStatus(401);
    }

    /** @test */
    function it_requires_a_name()
    {
        $this->endpoint([])->assertJsonValidationErrors(['name']);
    }

    /** @test */
    function it_requires_a_unique_name()
    {
        CategoryFactory::create(1, true, ['name' => 'category']);

        $this->endpoint(
            CategoryFactory::make(1, ['name' => 'category'])->toArray()
        )->assertJsonValidationErrors(['name']);
    }

    /** @test */
    function it_requires_an_exists_parent_id()
    {
        $this->endpoint(
            CategoryFactory::make(1, ['parent_id' => 10])->toArray()
        )->assertJsonValidationErrors(['parent_id']);
    }

    /** @test */
    function it_requires_a_valid_parent()
    {
        $category = CategoryFactory::withChild(1)->create();

        $this->endpoint(
            CategoryFactory::make(1, ['parent_id' => $category->children->random()->id])->toArray()
        )->assertJsonValidationErrors(['parent_id']);
    }

    /** @test */
    function authenticated_admin_can_store_a_new_category()
    {
        $category = CategoryFactory::make();

        $this->endpoint($category->toArray())
            ->assertStatus(201)
            ->assertJsonFragment(['slug' => $category->slug]);

        $this->assertDatabaseHas('categories', $category->toArray());
    }

    /** @test */
    function authenticated_admin_can_store_a_new_category_with_an_image()
    {
        Storage::fake();

        $category = CategoryFactory::make(1, [
            'image' => $img = $this->generateImage()
        ]);

        $this->endpoint($category->toArray());

        $this->assertTrue(Storage::exists("categories/{$img->hashName()}"));
    }

    protected function endpoint($data = [])
    {
        return $this->signIn()->postJson(route('admin.categories.store'), $data);
    }
}
