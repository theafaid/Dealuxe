<?php

namespace App\Rules;

use App\Models\Address;
use Illuminate\Contracts\Validation\Rule;

class ValidShippingMethod implements Rule
{
    protected $addressId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($addressId)
    {
        $this->addressId = $addressId;
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
        if(! $address = $this->getAddress()) return false;

        return $address->shippingMethods->contains('id', $address->id);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Shipping Method!';
    }

    /**
     * Get the requested address of the order
     * @return mixed
     */
    protected function getAddress()
    {
        return Address::find($this->addressId);
    }
}
