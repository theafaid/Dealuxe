<?php

namespace Tests\Setup;

use App\Models\ShippingMethod;

class ShippingMethodFactory
{
    protected $city;

    /**
     * Assign a city for the shipping method
     * @param $city
     * @return $this
     */
    public function forCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Create a new shipping method
     * @param null $count
     * @param array $data
     * @return mixed
     */
    public function create($count = null, $data = [])
    {
        // create a shipping method
        $shippingMethod = factory(ShippingMethod::class, $count > 1 ? $count : null)->create($data);

        // assign a city for the shipping method if requested
        if($this->city)
            $this->city->shippingMethods()->attach($shippingMethod);

        return $shippingMethod;
    }
}
