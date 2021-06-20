<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
         'name', 'address_1', 'postal_code', 'city_id', 'default'
    ];

    /**
     * Check the default property is true
     * @return bool
     */
    public function isDefault()
    {
        return (bool) $this->default;
    }

    /**
     * Set default property to be false
     * @param $address
     */
    public function toggleDefault($address)
    {
        $address->update(['default' => false]);
    }

    /**
     * Get the user who owns the address
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the city of the address
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * Get shipping methods of the city of the address
     * @return mixed
     */
    public function shippingMethods()
    {
        return $this->city->shippingMethods();
    }
}
