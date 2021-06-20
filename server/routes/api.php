<?php

// Authentication
Route::group(['prefix' => 'auth'], function(){
    // Register
    Route::post('register', 'APIAuth\RegisterController')->name('register');
    // Login
    Route::post('login', 'APIAuth\LoginController')->name('login');
    // User info end point
    Route::get('me', 'APIAuth\MeController')->name('me');
});

// Categories
Route::get('categories', 'CategoryController@index')->name('categories.index');
// Products
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/{product}', 'ProductController@show')->name('products.show');
// Cart
Route::apiResource('cart', 'CartController', ['parameters' => ['cart' => 'ProductVariation']]);
// countries
Route::apiResource('countries', 'CountryController'); // wait fo store, update, delete && cities ['store, 'update, index'delete]
// addresses
Route::apiResource('addresses', 'AddressController');
// shipping methods for a city (by address)
Route::apiResource('cities/{city}/shipping-methods', 'CityShippingMethodsController'); // wait for [store, update, delete]
// orders
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('orders', 'OrderController');
});


// Localization
Route::get('/js/lang.js', function () {
    if(app()->environment() == 'local') cache()->clear();

    $strings = Cache::rememberForever('lang.js', function () {
        $lang = request('lang');

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    return [
        'locale' => request('lang'),
        'window.i18n' => $strings['site']
    ];
})->name('assets.lang');

Route::get('/site-settings', function() {
    return new \App\Http\Resources\SiteSettingResource(siteSettings());
});
