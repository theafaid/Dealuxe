<?php

namespace App\Providers;

use App\App\Cart;
use App\Models\Address;
use App\Observers\AddressObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {

            $user = $app->auth->user();

            return new Cart(
                $user ? $user->load(['cart.stock']) : null
            );
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        Address::observe(AddressObserver::class);
    }
}
