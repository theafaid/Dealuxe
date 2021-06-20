<?php

namespace App\Services\Orders;

use App\Models\User;
use App\Repositories\OrderRepository;

class OrderIndexService
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
     * @param $orders
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handle($orders, $wantsJson)
    {
        if(admin()) {
            return $wantsJson ? $orders : $this->toViewResponse();
        }

        return $orders;
    }

    /**
     * Get latest orders
     * @return mixed
     */
    public function latest()
    {
        return $this->order->latest();
    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function orders($user)
    {
        return admin() ? $this->ordersForAdmin() : $this->ordersByUser($user);
    }
    /**
     * Get order created by a specific user
     * @param User $user
     * @return mixed
     */
    protected function ordersByUser(User $user)
    {
        return $this->order->ownedBy($user);
    }

    /**
     * Return a collection of paginated orders for admin
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function ordersForAdmin()
    {
        return $this->order->paginated($forAdmin = true);
    }

    protected function toViewResponse()
    {
        return view('orders.index');
    }
}
