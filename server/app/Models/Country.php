<?php

namespace App\Models;

use App\Traits\Supportable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Supportable;

    public $timestamps = false;

    protected $fillable = [
        'code', 'name', 'supported'
    ];

    /**
     * Fetch all cities that assigned to this country
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class);
    }
}
