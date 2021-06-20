<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    /**
     * Fetch data from a specific categories using categories slug
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function apply(Builder $builder, $value)
    {
        if(! $value) return $builder;

        return $builder->whereHas('categories', function ($category) use ($value) {
            return $category->whereSlug($value);
        });
    }
}
