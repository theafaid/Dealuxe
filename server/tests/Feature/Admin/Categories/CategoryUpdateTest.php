<?php

namespace Tests\Feature\Admin\Categories;

use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryUpdateTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_store_a_category()
    {
        $this->patchJson(route('admin.categories.update', 1), [])
            ->assertStatus(401);
    }

    /** @test */
    function it_fails_if_invalid_category()
    {
        $this->signIn()->patchJson(route('admin.categories.update', 'test'), [])
            ->assertStatus(404);
    }

    /** @test */
    function it_requires_a_name()
    {
        $category = CategoryFactory::create();

        $this->endpoint($category->slug)->assertJsonValidationErrors(['name']);
    }

    /** @test */
    function it_requires_a_unique_name()
    {
        $category1 = CategoryFactory::create();
        $category2 = CategoryFactory::create();

        $this->endpoint(
            $category2->slug, ['name' => $category1->name]
        )->assertJsonValidationErrors(['name']);
    }

    /** @test */
    function it_passes_if_name_the_same()
    {
        $category = CategoryFactory::create();

        $this->endpoint(
            $category->slug, ['name' => $category->name]
        )->assertJsonMissingValidationErrors(['name']);
    }

    /** @test */
    function it_requires_an_exists_parent_id()
    {
        $category = CategoryFactory::create();

        $this->endpoint(
            $category->slug, ['parent_id' => 10]
        )->assertJsonValidationErrors(['parent_id']);
    }

    /** @test */
    function it_fails_if_parent_id_is_a_child_id()
    {
        $category = CategoryFactory::withChild(1)->create();

        $this->endpoint(
            $category->slug, ['parent_id' => $category->children->random()->id]
        )->assertJsonValidationErrors(['parent_id']);
    }

    /** @test */
    function it_fails_if_the_parent_id_is_the_same_requested_category_id()
    {
        $category = CategoryFactory::create();

        $this->endpoint(
            $category->slug, ['parent_id' => $category->id]
        )->assertJsonValidationErrors(['parent_id']);
    }

    /** @test */
    function authenticated_admin_can_update_a_category()
    {
        $category = CategoryFactory::create();

        $this->withoutExceptionHandling();
        $this->endpoint(
            $category->slug,
            $updatedCategory = CategoryFactory::make(1, ['name' => 'test'])->toArray()
        )->assertJsonFragment(['slug' => $category->slug]);

        $this->assertDatabaseHas('categories', [
            'name' => 'test',
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
        ]);
    }

    /** @test */
    function authenticated_admin_can_update_a_category_with_an_image()
    {
        Storage::fake();

        $category = CategoryFactory::create();

        $this->endpoint(
            $category->slug,
            $updatedCategory = array_merge($category->toArray(), [
                'image' => $img = $this->generateImage()
            ])
        );

        $this->assertTrue(Storage::exists("categories/{$img->hashName()}"));
    }

    /** @test */
    function authenticated_admin_can_update_the_old_image_for_a_category()
    {
        Storage::fake();

        Storage::put('categories', $img = $this->generateImage());


        $category = CategoryFactory::create(1, true, [
            'image' => $oldImagePath = "categories/{$img->hashName()}"
        ]);

        $this->endpoint(
            $category->slug,
            $updatedCategory = array_merge(CategoryFactory::make()->toArray(), [
                'image' => $newImage = $this->generateImage()
            ])
        );

        $this->assertFalse(Storage::exists($oldImagePath));
        $this->assertTrue(Storage::exists("categories/{$newImage->hashName()}"));
    }

    protected function endpoint($slug, $data = [])
    {
        return $this->signIn()->patchJson(route('admin.categories.update', $slug), $data);
    }
}
