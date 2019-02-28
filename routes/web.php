<?php
// welcome page
Route::get('/', 'WelcomePageController@index')->name('welcome');
// shop page
Route::get('/shop', 'ShopController@index')->name('shop.index');
// single product page
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
// searching
Route::get('/search', 'SearchController@index')->name('search');

// User must verified his email
Route::group(['middleware' => 'verified'], function(){
    // view profile
    Route::get('/profile', 'ProfilesController@index')->name('profile.index');
    // update address
    Route::patch('/profile/address', 'ProfilesController@updateAddress')->name('profile.updateAddress');
    // show cart
    Route::get('/cart', 'CartController@index')->name('cart.index');
    // add a product to cart
    Route::post('/cart', 'CartController@store')->name('cart.store');
    // clear cart
    Route::post('/cart/clear', 'CartController@clear')->name('cart.clear');
    // update cart
    Route::patch('/cart/update', 'CartController@update')->name('cart.update');
    // remove a product fom a cart
    Route::delete('/cart/remove', 'CartController@remove')->name('cart.remove');
    // show wish list
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
    // add a product to wish list
    Route::post('/wishlist', 'WishlistController@store')->name('wishlist.store');
    // clear the wish list
    Route::post('/wishlist/clear', 'WishlistController@clear')->name('wishlist.clear');
    // remove a product from the wish list
    Route::delete('/wishlist/remove', 'WishlistController@remove')->name('wishlist.remove');
    // view checkout page
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    // pay
    Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
    // store a coupon for a user
    Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
    // remove a coupon
    Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.remove');
    // view thankyou page after the payment
    Route::get('/thankyou', 'ConfirmationController@index')->name('thankyou');
});

Auth::routes(['verify' => true]);

// Admin panel routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

