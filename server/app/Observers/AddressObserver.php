<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the address "creating" event.
     *
     * @param  \App\Address  $address
     * @return void
     */
    public function creating(Address $address)
    {
        $user = app()->runningUnitTests() ? $address->user : auth()->user();

        if((bool) $address->default) {
            // Toggle the default address for the authenticated user who is the creator of the new address
            $address = $user->defaultAddress();
            $address ? $address->toggleDefault($address) : null;
        }
    }
}
