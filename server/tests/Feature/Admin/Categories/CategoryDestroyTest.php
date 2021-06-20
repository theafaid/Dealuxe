<?php

namespace Tests\Feature\Admin\Categories;

use Facades\Tests\Setup\CategoryFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryDestroyTest extends TestCase
{
    /** @test */
    function unauthenticated_admin_cannot_delete_a_category()
    {
        $this->deleteJson(route('admin.categories.destroy', 'test'), [])
            ->assertStatus(401);
    }


    /** @test */
    function it_fails_if_invalid_category()
    {
        $this->deleteJson('test', [])
            ->assertStatus(404);
    }

    /** @test */
    function admin_can_delete_a_category()
    {
        $category = CategoryFactory::create();

        $this->endpoint($category->slug)
            ->assertStatus(204);

        $this->assertDatabaseMissing('categories', ['slug' => $category->slug]);
    }

    /** @test */
    function it_deletes_the_category_image_when_destroing()
    {
        Storage::put('categories', $file = UploadedFile::fake()->image('img.png'));
        $category = CategoryFactory::create(1, true, [
            'image' => $imagePath = "categories/{$file->hashName()}"
        ]);

        $this->assertTrue(Storage::exists($imagePath));

        $this->endpoint($category->slug)
            ->assertStatus(204);

        $this->assertFalse(Storage::exists($imagePath));

    }


    protected function endpoint($slug, $data = [])
    {
        return $this->signIn()->deleteJson(route('admin.categories.destroy', $slug), $data);
    }
}
