<?php

namespace App\Listeners;

use App\Coupon;

class UpdateCouponSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        if($couponSession = session('coupon')){
            $coupon = Coupon::findByCode($couponSession['code']);
            if($coupon['type'] == 'percent') {
                $coupon->addToSession(auth()->user()->cartTotal($toDollar = false, $dollarSign = false));
            }
        }
    }
}
