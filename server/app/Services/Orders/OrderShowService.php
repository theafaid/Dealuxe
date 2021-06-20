<?php

namespace App\Services\Orders;

use App\Repositories\OrderRepository;

class OrderShowService
{
    protected $order;

    /**
     * OrderIndexService constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->order = $orderRepository;
    }

    /**
     * @param $order
     * @return mixed
     */
    public function handle($order)
    {
        return $order->load($this->order->additionalData(['user']));
    }
}
