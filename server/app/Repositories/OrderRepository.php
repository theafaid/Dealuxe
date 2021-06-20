<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get orders by a specific user
     * @param $user
     * @param int $count
     * @return mixed
     */
    public function ownedBy($user, $count = 10)
    {
        return $user->orders()->with($this->additionalData())
            ->latest()->paginate($count);
    }

    /**
     * Get paginated orders
     * @param int $count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginated($forAdmin = false, $count = 10)
    {
        return $this->order
            ->with(
                $forAdmin ? 'user' : $this->additionalData()
            )
            ->latest()
            ->paginate($count);
    }

    /**
     * Fetch latest orders
     * @return mixed
     */
    public function latest()
    {
        return $this->order->latest()->limit(5)->get();
    }

    public function additionalData($data = [])
    {

        return array_merge($data, [
            'products',
            'products.stock',
            'products.product',
            'products.product.variations',
            'products.product.variations.stock',
            'address',
            'shippingMethod',
//            'paymentMethod',
        ]);
    }
}
