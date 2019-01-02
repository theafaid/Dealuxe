<?php

namespace App\Http\Controllers;


use App\Coupon;

class CouponsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(){

        request()->validate(['coupon' => 'required|string|exists:coupons,code']);

        $coupon = Coupon::findByCode(request('coupon'));


        $cartTotal = auth()->user()->cartTotal(false, false);

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount($cartTotal),
            'value' => 'cent'
        ]);

        return session('coupon');


        return redirect(route('checkout.index'))
            ->with('success', __('front.coupon_applied_successfully'));
    }

    public function destroy(){

    }
}
