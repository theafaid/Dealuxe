<?php

namespace App\Services\Cart;

use App\App\Cart;

class CartIndexService
{
    protected $user, $cart;

    /**
     * CartStoreService constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
        $this->cart = new Cart($this->user);
    }

    /**
     * Sync the cart then load additional relations for the authenticated user
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function handle()
    {
        $this->cart->sync();

        $this->user->load($this->relations());

        return $this->user;
    }

    /**
     * Additional meta data for cart index
     * @return array
     */
    public function getMetaData()
    {
        return [
            'empty' => $this->cart->isEmpty(),
            'subtotal' => $this->cart->subtotal()->formatted(),
            'total' => $this->cart->withShipping(request('shipping_method_id'))->total()->formatted(),
            'shipping_price' => $this->cart->shippingPrice()->formatted(),
            'changed' => $this->cart->hasChanged(),
        ];
    }

    /**
     * Get loaded relations for the authenticated user
     * @return array
     */
    protected function relations()
    {
        return [
            'cart.product',
            'cart.product.variations.stock',
            'cart.stock',
        ];
    }
}
