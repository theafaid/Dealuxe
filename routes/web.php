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
Route::delete('/wishlist/remove', 'WishlistController@remove')->name('wishlist.remove');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/thankyou', function(){
    return "thank you for you payment";
})->name('thankyou');
Route::view('/product', 'product');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
