<?php

namespace App\Services\Orders;

use App\App\Cart;
use App\Events\Order\OrderCreated;

class OrderStoreService
{
    protected $user, $cart;

    /**
     * OrderStoreService constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
        $this->cart = new Cart($this->user);
    }

    /**
     * Persist storing an order for the authenticated user
     * @param $orderData
     * @return mixed
     */
    public function handle($orderData)
    {
        $order = $this->createOrder($orderData);

        $this->assignProductsToOrder($order);

        event(new OrderCreated($this->cart));

        return $order->fresh()->load($this->additionalData());
    }

    /**
     * Make cart products handled for the order
     * @return mixed
     */
    protected function orderProducts()
    {
        return $this->cart->products()->keyBy('id')->map(function ($product) {
            return ['quantity' => $product->pivot->quantity];
        })->toArray();
    }

    /**
     * Create a new order for the authenticated user
     * @param $data
     * @return mixed
     */
    protected function createOrder($data)
    {
        return $this->user->orders()->create(
            array_merge (
                $data, ['subtotal' => $this->subtotal(), 'code' => uniqid('order_')]
            )
        );
    }

    /**
     * Attach cart product to order
     * @param $order
     */
    protected function assignProductsToOrder($order)
    {
        $order->products()->sync($this->orderProducts());
    }

    /**
     * Get cart subtotal for the authenticated user
     * @return string
     */
    public function subtotal()
    {
       return $this->cart->subtotal()->amount();
    }

    /**
     * Additional data that will return after creating the order
     * @return array
     */
    protected function additionalData()
    {
        return ['products', 'address', 'shippingMethod'];
    }
}
