<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (static::$hasUniqueName == true) {
                $model->slug = Str::slug($model->name);
            } else {
                if(static::whereName($model->name)->exists()) {
                    $model->slug = Str::slug($model->name . time());
                } else {
                    $model->slug = Str::slug($model->name);
                }
            }
        });
    }
}
