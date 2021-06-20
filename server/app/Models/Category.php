<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasSlug;

    protected static $hasUniqueName = true;

    protected $fillable = [
        'name', 'slug', 'order', 'parent_id', 'image',
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * Get ordered categories
     * @param Builder $builder
     * @param string $direction
     */
    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }

    /**
     * Get parent categories
     * @param Builder $builder
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }


    /**
     * Get the category parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Check if the category is a parent category
     * @return bool
     */
    public function isParent()
    {
        return !! $this->parent_id == null;
    }
    /**
     * Get parent children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
