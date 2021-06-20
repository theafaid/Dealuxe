<?php

namespace App\Models;

use App\Traits\Supportable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Supportable;

    public $timestamps = false;

    protected $fillable = [
      'name', 'district', 'country_id', 'supported',
    ];

    protected $with = ['country'];

    /**
     * Check if City is supported
     * @return bool
     */
    public function isSupported()
    {
        return (bool) $this->supported && $this->country->isSupported();
    }

    /**
     * Get the country of the city
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Fetch all attached shipping methods for the city
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class);
    }

}
