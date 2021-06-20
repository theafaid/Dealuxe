<?php

namespace App\Repositories;

use App\Models\ShippingMethod;

class ShippingMethodRepository
{
    protected $shippingMethod;

    /**
     * ProductRepository constructor.
     * @param ShippingMethod $shippingMethod
     */
    public function __construct(ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get a list of shipping methods
     * @return ShippingMethod[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return $this->shippingMethod->with('cities')->get();
    }

    /**
     * Store a shipping method
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $shippingMethod =  $this->shippingMethod->create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        $shippingMethod->cities()->sync($data['cities']);

        return $shippingMethod->load('cities');
    }
}
