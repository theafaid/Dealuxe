<?php

namespace Tests\Setup;

use App\Models\Address;

class AddressFactory
{
    protected $supportedCity = true;
    protected $supportedCountry = true;
    protected $user;

    public function ownsBy($user)
    {
        $this->user = $user;

        return $this;
    }
    /**
     * Make the city of the address UnSupported
     * @return $this
     */
    public function inUnsupportedCity()
    {
        $this->supportedCity = false;

        return $this;
    }

    /**
     * Make the city of the address Supported
     * @return $this
     */
    public function inSupportedCity()
    {
        $this->supportedCity = true;

        return $this;
    }

    /**
     * Make the country of the city of the address Unsupported
     * @return $this
     */
    public function inUnsupportedCountry()
    {
        $this->supportedCountry = false;

        return $this;
    }

    /**
     * Create a new address
     * @param array $data
     * @return mixed
     */
    public function create($data = [])
    {
        $address = factory(Address::class)->create(
            $this->user ? array_merge(['user_id' => $this->user->id], $data) : $data
        );

        $address->city->update(['supported' => $this->supportedCity]);

        if(! $this->supportedCountry)
            $address->city->country->update(['supported' => false]);

        return $address;
    }
}
