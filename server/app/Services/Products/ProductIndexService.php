<?php

namespace App\Services\Products;

use App\Scoping\Scopes\CategoryScope;
use App\Repositories\ProductRepository;

class ProductIndexService
{
    protected $product;

    /**
     * ProductIndexService constructor.
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * Return
     * @param $products
     * @param $wantsJson
     * @return mixed
     */
    public function handle($products, $wantsJson = true)
    {
        return $wantsJson ? $products : $this->toViewResponse($products);
    }

    /** A collection of paginated data with scopes
     * @param $request
     * @return mixed
     */
    public function products($request)
    {
        return $this->product->paginated(
            $this->scopes(), $request, $count = 15
        );
    }

    /**
     * Get product Scopes
     * @return array
     */
    protected function scopes()
    {
        return [
            'category' => new CategoryScope,
        ];
    }

    /**
     * It returns a view with categories data
     * @param $products
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function toViewResponse($products)
    {
        return view('products.index', [
            'products' => $products,
        ]);
    }
}
