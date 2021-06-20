<?php

namespace Tests\Setup;

use App\Models\Order;
use Facades\Tests\Setup\UserFactory;

class OrderFactory
{
    protected $user;
    protected $productsCount;
    protected $productsCustomData;
    protected $productsQuantity;


    public function forUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function withProducts($count, $data = [], $quantity = 1)
    {
        $this->productsCount = $count;
        $this->productsCustomData = $data;
        $this->productsQuantity = $quantity;

        return $this;
    }

    public function generateDataForCreatingAnOrder()
    {
        $user = UserFactory::putInCart(
            $productVariationsCount = 2,
            $quantityOfVariation = 1,
            $stockCount = 2,
            $customData = []
        )->create();


        return $user;
    }

    public function create($data = [])
    {
        $order = factory(Order::class)->create(array_merge ($data, [
            'user_id' => $this->user ? $this->user->id : \Facades\Tests\Setup\UserFactory::create()->id,
        ]));

        if($this->productsCount){
            $order->products()->attach(
                \Facades\Tests\Setup\ProductVariationFactory::create(
                    $this->productsCount, $this->productsCustomData
                ), ['quantity' => $this->productsQuantity]
            );
        }

        return $order;
    }
}
