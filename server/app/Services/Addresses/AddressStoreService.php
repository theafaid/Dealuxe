<?php

namespace App\Services\Addresses;


use App\Http\Resources\AddressResource;
use App\Models\Address;

class AddressStoreService
{
    protected $user ;

    /**
     * AddressStoreService constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Store a new address for the authenticated user
     * @param $data
     * @return mixed
     */
    public function handle($data)
    {
        $address = Address::make($data);

        $this->user->addresses()->save($address);

        return $address;
    }

}
