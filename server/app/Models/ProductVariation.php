<?php

namespace App\Models;

use App\App\Money;
use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded = [];

    use HasPrice;

    /**
     * Get price for a product variation
     * It inherit price from base product if the product variation price is nullable
     * @param $value
     * @return Money
     */
    public function getPriceAttribute($value)
    {
        if($value == null) return $this->product->price;

        return new Money($value);
    }

    /**
     * Check if the price does not match parent
     * @return bool
     */
    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    /**
     * Return the minimum quantity [requested quantity or the all stock count]
     * @param $count
     * @return mixed
     */
    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }

    /**
     * Get stock count for product variation
     * @return mixed
     */
    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
    }

    /**
     * Check if product variation is in stock
     * @return bool
     */
    public function inStock()
    {
        return !! $this->stockCount() ;
    }

    /**
     * Get product variation type
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(
            ProductVariationType::class,'id', 'product_variation_type_id'
        );
    }

    /**
     * Get assigned product to variation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get Product variation stocks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Single stock representation for product variation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stock()
    {
        return $this->belongsToMany(
            ProductVariation::class,'product_variation_stock_view'
        )->withPivot(['stock', 'in_stock']);
    }
}
