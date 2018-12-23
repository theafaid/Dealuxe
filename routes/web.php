<?php

Route::get('/', 'WelcomePageController@index');
Route::get('/shop', 'ShopController@index');
Route::view('/product', 'product');
Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
