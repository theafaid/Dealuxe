<?php

namespace App\App;

use App\Models\ShippingMethod;

class Cart
{
    protected $user, $changed = false, $shippingMethod;

    /**
     * Fetch all cart products (variations)
     * @return mixed
     */
    public function products()
    {
        return $this->user->cart;
    }

    /**
     * Cart constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Add a products to authenticated user cart with it's quantity for every single product
     * @param $products
     */
    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching($products);
    }

    /**
     * Update a product variation quantity
     * @param $productId
     * @param $quantity
     */
    public function update($productId, $quantity)
    {
        $this->user->cart()->updateExistingPivot(
            $productId, ['quantity' => $quantity]
        );
    }

    /**
     * Delete a product from the cart
     * @param $productId
     */
    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }

    /**
     * Empty cart
     */
    public function empty()
    {
        $this->user->cart()->detach();
    }

    /**
     * Check if the cart is empty
     * If we have an item in the cart with quantity of 0 this means the cart is empty
     * @return bool
     */
    public function isEmpty()
    {
        // return $this->user->cart()->count(); >> quantity of cart items can be equal to zero.

        return $this->user->cart->sum('pivot.quantity') <= 0;
    }

    /**
     * Reduce requested amount of quantities if stock not have it
     */
    public function sync()
    {
        $this->user->cart->each(function ($product) {
            // Quantity will be equals to the requested quantity or all stock quantities
            $stockQty = $product->minStock($requestedQty = $product->pivot->quantity);

            // Changed property to check if the requested quantity has changed because of stock not provide that quantity
            if($stockQty !== $requestedQty) $this->changed = true;

            // For example: the stock has 99 of quantity for selected product and the requested quantity
            // is 100 of quantity so this means the requested quantity will be updated to 99 of quantity
            // which is the maximum quantity of product that stock provide.
            $product->pivot->update(['quantity' => $stockQty]);
        });
    }

    /**
     * Check if the cart quantities for products has changed
     * @return bool
     */
    public function hasChanged()
    {
        return $this->changed;
    }

    /**
     * Get shipping method price
     * @return Money
     */
    public function shippingPrice() {
        return new Money(0);
    }
    /**
     * Return the selected shipping method
     * @param $shippingMethodId
     * @return $this
     */
    public function withShipping($shippingMethod)
    {
        $shippingMethod = ShippingMethod::where('id', $shippingMethod)->first();

        $this->shippingMethod = $shippingMethod;

        return $this;
    }
    /**
     * Get the subtotal for the cart
     * It returns the submission of price of all items according to qnt
     * @return Money
     */
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    /**
     * Get total of user cart
     * It returns the submission of the subtotal with additional prices like shipping
     * @return Money
     */
    public function total()
    {
        if (! $shippingMethod = $this->shippingMethod) return $this->subtotal();

        return $this->subtotal()->add($shippingMethod->price);
    }

}
