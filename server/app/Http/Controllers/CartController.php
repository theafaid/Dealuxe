<?php

namespace App\Http\Controllers;

use App\App\Cart;
use App\Models\ProductVariation;
use App\Http\Resources\CartResource;
use App\Http\Requests\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Services\Cart\CartIndexService;
use App\Services\Cart\CartStoreService;

class CartController extends Controller
{
    protected $indexService, $storeService, $cart;

    public function __construct(CartIndexService $indexService, CartStoreService $storeService)
    {
        $this->middleware('auth:api');
        $this->cart = new Cart(auth()->user());
        $this->indexService = $indexService;
        $this->storeService = $storeService;
    }

    /**
     * Index Cart
     * @return CartResource
     */
    public function index()
    {
        return (new CartResource($this->indexService->handle()))->additional([
            'meta' => $this->indexService->getMetaData()
        ]);
    }

    /**
     * Store a product into the cart
     * @param CartStoreRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CartStoreRequest $request)
    {
        $this->storeService->store($request->products);

        return response([], 201);
    }

    /**
     * Update a product quantity in the cart
     * @param ProductVariation $ProductVariation
     * @param CartUpdateRequest $request
     */
    public function update(ProductVariation $ProductVariation, CartUpdateRequest $request)
    {
        $this->cart->update($ProductVariation->id, $request->quantity);

        $this->cart->sync();
    }

    /**
     * Delete a specific product from cart
     * @param ProductVariation $ProductVariation
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(ProductVariation $ProductVariation)
    {
        $this->cart->delete($ProductVariation->id);

        return response([], 204);
    }
}
