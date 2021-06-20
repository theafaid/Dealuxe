<?php

namespace App\Services\Products;

use App\Models\ProductVariationType;
use App\Services\Uploads\UploadService;
use App\Repositories\ProductRepository;

class ProductStoreService
{
    protected $product, $uploadService;

    /**
     * ProductIndexService constructor.
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product, UploadService $uploadService)
    {
        $this->product = $product;
        $this->uploadService = $uploadService;
    }

    /**
     * Handle creating a product
     * @param $request
     * @return mixed
     */
    public function handle($request)
    {
        $product = $this->createProduct($request->validated());

        foreach($request['variations'] as $variation) {
            $this->createVariation($product, $variation);
        }
        return $product;
    }

    /**
    * Create a product
     * @param $data
     * @return mixed
     */
    protected function createProduct($data)
    {
        return $this->product->create([
            'name' => $data['name'],
            'price' => $this->priceToCent($data['price']),
            'description' => $data['description'],
            'main_image' => $this->uploadImages('main_image'),
            'additional_images' => $this->uploadImages('additional_images'),
        ]);
    }

    /**
     * Create a variation for the created product
     * @param $product
     * @param $variation
     */
    protected function createVariation($product, $variation)
    {
        $createdVariation = $product->variations()->create([
            'name' => $variation['name'],
            'price' => $this->priceToCent($variation['price']),
            'order' => $variation['order'],
            'product_variation_type_id' => $this->createProductVariationType($variation['type'])->id,
        ]);

        $this->addVariationToStock($createdVariation, $variation['quantity']);
    }

    /**
     * Create a type for the variation of the product
     * @param $type
     * @return mixed
     */
    protected function createProductVariationType($type)
    {
        return ProductVariationType::create(['name' => $type]);
    }

    /**
     * Make variation available in stock
     * @param $variation
     * @param $quantity
     */
    protected function addVariationToStock($variation, $quantity)
    {
        $variation->stocks()->create(['quantity' => $quantity ]);
    }


    /**
     * Upload requested images
     * @param $images
     * @return mixed
     */
    protected function uploadImages($fileName)
    {
        if(request()->hasFile($fileName)) {
            return $this->uploadService->upload($fileName, 'products');
        }
    }

    /**
     * Convert prices to cents
     * @param $price
     * @return float|int
     */
    protected function priceToCent($price)
    {
        return $price * 100;
    }
}
