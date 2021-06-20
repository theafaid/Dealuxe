<?php

namespace Tests\Setup;

use App\Models\City;

class CityFactory
{
    protected $country;

    /**
     * Put city in a specific country
     * @param null $country
     * @param bool $supported
     * @return $this
     */
    public function inCountry($country = null, $supported = true)
    {
        $country['supported'] = $supported;
        $this->$country = $country;

        return $this;
    }

    /**
     * Create a new city
     * @param bool $supportedCity
     * @param bool $supportedCountry
     * @return mixed
     */
    public function create($supportedCity = true, $supportedCountry = true)
    {
        // create the city
        $city = factory(City::class)->create(['supported' => $supportedCity]);

        // update the country of the city if requested x
        if($this->country){
            $city->update(['country_id' => $this->country->id]);
        }

        // change support status of the country of the city
        if(! $supportedCountry)
            $city->country->toggleSupport();

        return $city;
    }
}
