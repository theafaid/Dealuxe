<?php

namespace App\Models;

use App\App\Money;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'address_id', 'status', 'shipping_method_id', 'subtotal', 'code'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->code = uniqid();
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return "code";
    }

    /**
     * Get subtotal instance of money
     * @param $subtotal
     * @return Money
     */
    public function getSubtotalAttribute($subtotal)
    {
        return new Money($subtotal);
    }

    /**
     * Get the total amount of the order
     * @return mixed
     */
    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }

    /**
     * Get the user who created the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the address of the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Fetch products of the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation_order')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the shipping method of the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}
