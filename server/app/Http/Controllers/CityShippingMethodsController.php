<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Resources\ShippingMethodResource;

class CityShippingMethodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show a list of shipping method for a city
     * @param City $city
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(City $city)
    {
        return ShippingMethodResource::collection($city->shippingMethods);
    }

}
