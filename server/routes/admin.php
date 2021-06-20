<?php

Route::prefix(
    LaravelLocalization::setLocale())
    ->middleware( ['localizationRedirect', 'localeViewPath' ])
    ->name('admin.')
    ->group(function () {
        Route::prefix('dashboard')->group(function () {
       Route::group(['namespace' => 'Admin'], function () {
           /////////////////// Routes requires authentication ////////////////////////

           Route::get('/', 'DashboardController@index')->name('dashboard.index'); // Dashboard index
           Route::get('/theme/{theme}', 'DashboardController@setDashboardThemeMode');
           Route::get('/layout/{color}', 'DashboardController@setDashboardLayoutColor');
           /////////////////// Routes not requires authentication ////////////////////////
           Auth::routes(['register' => false]); // Authentication routes
           Route::any('logout', 'Auth\LoginController@logout'); // Logout routes
       });
       //////////////////////// Routes requires authentication ///////////////////////////
       Route::group(['middleware' => 'auth:admin'], function () {
           Route::resource('admins', 'Admin\AdminController');
           Route::resource('categories', 'CategoryController');
           Route::resource('products', 'ProductController');
           Route::resource('orders', 'OrderController');
           Route::resource('shipping-methods', 'Admin\ShippingMethodsController');
           Route::get('settings', 'Admin\SiteSettingController@index')->name('settings.index');


           // Localization
           Route::get('/js/lang.js', function () {
               \Cache::forget('lang.js');
               $strings = Cache::rememberForever('lang.js', function () {
                   $lang = config('app.locale');

                   $files   = glob(resource_path('lang/' . $lang . '/*.php'));
                   $strings = [];

                   foreach ($files as $file) {
                       $name           = basename($file, '.php');
                       $strings[$name] = require $file;
                   }

                   return $strings;
               });

               header('Content-Type: text/javascript');
               echo('window.i18n = ' . json_encode($strings) . ';');
               exit();
           })->name('assets.lang');

       });
   });
});

