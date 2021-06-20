<?php

namespace App\Services\Cart;

use App\App\Cart;

class CartStoreService
{
    protected $cart, $user;

    /**
     * CartStoreService constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
        $this->cart = new Cart($this->user);
    }

    /**
     * Store a product in the authenticated user cart
     * @param $products
     */
    public function store($products)
    {
        $this->cart->add($this->getPayload($products));
    }

    /**
     * Get store products with it's quantities
     * @param $products
     * @return array
     */
    protected function getPayload($products)
    {

        return collect($products)->keyBy('id')->map(function ($product) {
            return ['quantity' => $this->getQuantity($product)];
        })->toArray();
    }

    /**
     * Returns a Submission of quantities
     * @param $product
     * @return array
     */
    protected function getQuantity($product)
    {
        return $product['quantity'] + $this->getCurrentQuantity($product['id']);
    }

    /**
     * Get the current quantity of a specific product variation in the cart
     * @param $productId
     * @return int
     */
    protected function getCurrentQuantity($productId)
    {
        $product = $this->user->cart->where('id', $productId)->first();

        return $product ? $product->pivot->quantity : 0 ;
    }
}
