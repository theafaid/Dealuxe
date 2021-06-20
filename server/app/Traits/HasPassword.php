<?php

namespace App\Traits;

trait HasPassword
{
    protected static function bootHasPassword()
    {
        // Encrypt password when creating
        static::creating(function ($model) {
            $model->password = bcrypt($model->password);
        });
    }
}
