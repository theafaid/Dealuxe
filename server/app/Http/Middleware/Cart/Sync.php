<?php

namespace App\Http\Middleware\Cart;

use Closure;
use App\App\Cart;

class Sync
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->cart->sync();

        if($this->cart->hasChanged()) {
            return response()->json([
                'message' => __('site.cart_has_changed')
            ], 409);
        }

        return $next($request);
    }
}
