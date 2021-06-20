<?php

namespace Tests\Setup;

use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductFactory
{
    protected $variationsCount = 0;
    protected $variationsData = [];

    /**
     * Assign variations to product
     * @param $count
     * @param array $data
     * @return $this
     */
    public function withVariations($count, $data = [])
    {
        $this->variationsCount = $count;
        $this->variationsData = $data;

        return $this;
    }

    /**
     * Create a product with it's variations
     * @param null $count
     * @param array $data
     * @return mixed
     */
    public function create($count = null, $data = [])
    {
        $product =  factory(Product::class, $count != null && $count != 1 ? $count : null)->create($data);

        $this->variationsCount ? $this->createVariations($product, $this->variationsCount, $this->variationsData) : null;

        return $product;
    }

    public function byAdmin($mainImage, $additional_images = null)
    {
        $product = factory(Product::class)->make();

        return [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price->amount(),
            'main_image' => $mainImage,
            'additional_images' => $additional_images ?: [],
            'variations' => [
                [
                    'name' => 'variation_name',
                    'type' => 'variation_type',
                    'price' => '1000',
                    'quantity' => 10,
                    'order' => 1,
                ]
            ]
        ];
    }
    /**
     * Create a variations for a product
     * @param $product
     * @param $count
     * @param $data
     */
    protected function createVariations($product, $count, $data)
    {
        $product->variations()->save(
            \Facades\Tests\Setup\ProductVariationFactory::create($count, $data)
        );
    }
}
