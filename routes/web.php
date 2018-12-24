<?php

Route::get('/', 'WelcomePageController@index')->name('welcome');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::post('/cart/clear', 'CartController@clear')->name('cart.clear');
Route::delete('/cart/remove', 'CartController@remove')->name('cart.remove');

Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
Route::post('/wishlist', 'WishlistController@store')->name('wishlist.store');
Route::post('/wishlist/clear', 'WishlistController@clear')->name('wishlist.clear');

Route::view('/product', 'product');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
