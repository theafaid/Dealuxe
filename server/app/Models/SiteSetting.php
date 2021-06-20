<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Put site settings in cache after creating
        static::created(function ($siteSetting) {
            cache()->rememberForever(static::cacheKey(), function () use ($siteSetting) {
                return $siteSetting;
            });
        });
    }

    /**
     * Get cache key of the site settings
     * @return string
     */
    protected static function cacheKey()
    {
        return ! app()->runningUnitTests() ? "site_settings" : "site_settings_test";
    }
}
