<?php

Route::get('/', 'WelcomePageController@index')->name('welcome');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::get('/cart', 'CartController@index')->name('cart.index');

Route::view('/product', 'product');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
