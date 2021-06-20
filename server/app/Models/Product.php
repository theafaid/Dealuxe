<?php

namespace App\Models;

use App\Scoping\Scoper;
use App\Traits\HasSlug;
use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static $hasUniqueName = false;
    protected $fillable = ['name', 'price', 'description', 'main_image', 'additional_images'];
    use  HasPrice, HasSlug;

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getMainImageAttribute($value)
    {
        return url(
            $value ? "storage/{$value}" : "design/admin/img/default_product.png"
        );
    }

    /**
     * Filter products by scoping
     * @param Builder $builder
     * @param $scopes
     * @return Builder
     */
    public function scopeWithScopes(Builder $builder, array $scopes, $request)
    {
        return (new Scoper($request))->apply(
            $builder, $scopes
        );
    }

    /**
     * Check if any of product variation has any stock
     * @return bool
     */
    public function inStock()
    {
        return !! $this->stockCount();
    }

    /**
     * Fetch the submission of all stocks for all variations
     * @return mixed
     */
    public function stockCount()
    {
        return $this->variations->sum(function ($variation) {
            return $variation->stockCount();
        });
    }

    /**
     * Get all categories assigned to a product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get product variations
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)
            ->orderBy('order', 'desc');
    }
}
