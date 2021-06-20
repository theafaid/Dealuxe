<?php

if(! function_exists('admin')) {
    /**
     * Get authenticated admin data
     * @return mixed
     */
    function admin()
    {
        return auth()->guard('admin')->user();
    }
}

if(! function_exists('availabilityClass')) {
    /**
     * A class to return availability status with a bootstrap class name
     * @param $isTrue
     * @return string
     */
    function availabilityClass($isTrue)
    {
        return $isTrue ? 'badge badge-success' : 'badge badge-danger';
    }
}

if(! function_exists('activeUrl')) {
    /**
     * Check if the current active url is the same request segment
     * @param $url
     * @return string
     */
    function activeUrl($route)
    {
        return request()->routeIs($route) ? 'active' : '';
//        if(in_array($url, request()->segments())) return 'active';
    }
}

if(! function_exists('siteSettings')) {
    /**
     * Fetch a settings from the cache
     * @param null $key
     * @return |null
     * @throws Exception
     */
    function siteSettings($key = null)
    {
        $siteSettings = cache('site_settings');

        if(! $siteSettings) {
            $siteSettings = \App\Models\SiteSetting::first();
        }

        return $key ? $siteSettings[$key] : $siteSettings;
    }
}
