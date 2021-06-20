<?php

namespace App\Services\ShippingMethods;

use App\Repositories\ShippingMethodRepository;

class ShippingMethodIndexService
{
    protected $shippingMethod;

    public function __construct(ShippingMethodRepository $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get a list of all shipping methods
     * @return \App\Models\ShippingMethod[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function handle()
    {
        return $this->shippingMethod->get();
    }
}
