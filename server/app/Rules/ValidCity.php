<?php

namespace App\Rules;

use App\Models\City;
use Illuminate\Contracts\Validation\Rule;

class ValidCity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $city = City::find($value);

        // Check if the city is exists
        if(! $city) return false;

        // Check if the city is supported
        return $city->isSupported();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('site.city_not_supported');
    }
}
