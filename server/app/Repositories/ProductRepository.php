<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Return a paginated data using request scopes for products
     * @param $scopes
     * @param $request
     * @param int $count
     * @return mixed
     */
    public function paginated($scopes, $request, $count = 10)
    {
        return Product::with(['variations.stock'])->withScopes($scopes, $request)->paginate($count);
    }

    public function create($data)
    {
        return $this->product->create($data);
    }
}
