<?php

namespace Tests\Feature\Admin\Products;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Facades\Tests\Setup\ProductFactory;
use Illuminate\Support\Facades\Storage;

class ProductStoreTest extends TestCase
{
    /** @test */
    function unautheiticated_admin_cannot_see_create_product_page()
    {
        $this->get(route('admin.products.create'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function admin_can_view_create_product_page()
    {
        $this->signIn()->get(route('admin.products.create'))
            ->assertStatus(200)
            ->assertViewIs('products.create');
    }

    /** @test */
    function unautheiticated_admin_cannot_store_a_product()
    {
        $this->post(route('admin.products.store'))
            ->assertRedirect(route('admin.login'));
    }

    /** @test */
    function it_requires_a_name()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    function it_requires_a_price()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['price']);
    }

    /** @test */
    function it_requires_a_description()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['description']);
    }

    /** @test */
    function it_requires_a_main_image()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['main_image']);
    }

    /** @test */
    function it_requires_a_valid_main_image()
    {
        $this->endpoint(['image' => 'test'])
            ->assertSessionHasErrors(['main_image']);
    }

    /** @test */
    function additional_images_must_be_type_of_array()
    {
        $this->endpoint(['additional_images' => 'test'])
            ->assertSessionHasErrors(['additional_images']);
    }

    /** @test */
    function it_requires_a_valid_additional_images()
    {
        $this->endpoint(['additional_images' => [
            'file' => 'test'
        ]])
            ->assertSessionHasErrors(['additional_images.*']);
    }

    /** @test */
    function it_requires_a_product_variations()
    {
        $this->endpoint([])
            ->assertSessionHasErrors(['variations']);
    }

    /** @test */
    function product_variations_must_be_type_of_array()
    {
        $this->endpoint(['variations' => 'test'])
            ->assertSessionHasErrors(['variations']);
    }

    /** @test */
    function product_variation_must_be_type_of_array()
    {
        $this->endpoint(['variations' => ['test']])
            ->assertSessionHasErrors(['variations.*']);
    }

    /** @test */
    function a_product_variation_requires_a_name()
    {
        $this->endpoint(['variations' => [
            []
        ]])
            ->assertSessionHasErrors(['variations.*.name']);
    }

    /** @test */
    function a_product_variation_price_must_be_a_number()
    {
        $this->endpoint(['variations' => [
            ['price' => 'test']
        ]])
            ->assertSessionHasErrors(['variations.*.price']);
    }

    /** @test */
    function a_product_variation_requires_a_quantity()
    {
        $this->endpoint(['variations' => [
            []
        ]])
            ->assertSessionHasErrors(['variations.*.quantity']);
    }


    /** @test */
    function a_product_variation_requires_an_order()
    {
        $this->endpoint(['variations' => [
            []
        ]])
            ->assertSessionHasErrors(['variations.*.order']);
    }

    /** @test */
    function a_product_variation_requires_a_type()
    {
        $this->endpoint(['variations' => [
            []
        ]])
            ->assertSessionHasErrors(['variations.*.type']);
    }

    /** @test */
    function admin_can_store_a_product()
    {
        $this->withoutExceptionHandling();
        $product = ProductFactory::byAdmin(
            $mainImage = UploadedFile::fake()->image('main_image.jpg')
        );

        $this->endpoint($product)
            ->assertStatus(201);

        $this->assertEquals($product['name'], Product::first()->name);
    }

    /** @test */
    function it_stores_product_variations_when_creating_a_product()
    {
        $product = ProductFactory::byAdmin(
            $mainImage = UploadedFile::fake()->image('main_image.jpg')
        );

        $this->endpoint($product);

        foreach ($product['variations'] as $variation) {
            $this->assertDatabaseHas('product_variations', ['name' => $variation['name']]);
        }
    }

    /** @test */
    function it_stores_quantity_of_each_product_variation_in_stock()
    {
        $product = ProductFactory::byAdmin(
            $mainImage = UploadedFile::fake()->image('main_image.jpg')
        );

        $this->endpoint($product);

        foreach(Product::first()->variations as $variation) {
            $this->assertDatabaseHas('stocks', [
                'product_variation_id' => $variation['id'],
            ]);
        }
    }

    /** @test */
    function it_uploads_product_main_image_when_creating()
    {
        $this->withoutExceptionHandling();
        Storage::fake();

        $product = ProductFactory::byAdmin(
            $mainImage = UploadedFile::fake()->image('main_image.jpg')
        );

        $this->endpoint($product);

        $this->assertTrue(Storage::exists("products/{$mainImage->hashName()}"));
    }

    /** @test */
    function it_uploads_product_additional_images_when_creating()
    {
        $this->withoutExceptionHandling();
        Storage::fake();

        $product = ProductFactory::byAdmin(
            $mainImage = UploadedFile::fake()->image('main_image.jpg'),
            $additionalImages = [
                UploadedFile::fake()->image('additional_image1.jpg'),
                UploadedFile::fake()->image('additional_image1.jpg'),
            ]
        );
        $this->endpoint($product);

        foreach($additionalImages as $image)
        {
            $this->assertTrue(Storage::exists("products/{$image->hashname()}"));
        }
    }

    function endpoint($data = [])
    {
        return $this->signIn()->post(route('admin.products.store'), $data);
    }
}
