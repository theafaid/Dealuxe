<?php

namespace App\Services\ShippingMethods;

use App\Repositories\ShippingMethodRepository;

class ShippingMethodStoreService
{
    protected $shippingMethod;

    public function __construct(ShippingMethodRepository $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Store a new shipping method
     * @param $data
     * @return mixed
     */
    public function handle($data)
    {
        return $this->shippingMethod->store($data);
    }
}
