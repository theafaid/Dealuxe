<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductIndexResource;
use App\Services\Products\ProductIndexService;
use App\Services\Products\ProductStoreService;

class ProductController extends Controller
{

    protected $indexService, $storeService;

    /**
     * ProductController constructor.
     */
    public function __construct(ProductIndexService $indexService, ProductStoreService $storeService)
    {
        $this->indexService = $indexService;
        $this->storeService = $storeService;
    }

    /**
     * Return a collection of products
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $products =  ProductIndexResource::collection(
            $this->indexService->products($request = request())
        );

        return $this->indexService->handle($products, $request->wantsJson());
    }

    /**
     * Create a new product page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a product
     * @param ProductStoreRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
         $this->storeService->handle($request);

         return response(['message' => 'admin.product_created_successfully'], 201);
    }

    /**
     * Show a single product
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        $product->load([
            'variations.type', 'variations.stock', 'variations.product',
        ]);

        $product =  new ProductResource($product);

        if(request()->wantsJson()) return $product;

        return view('products.show', ['product' => json_decode(json_encode($product))]);
    }
}
