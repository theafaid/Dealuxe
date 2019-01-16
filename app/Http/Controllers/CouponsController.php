<?php

namespace App\Http\Controllers;


use App\Coupon;
use App\Http\Requests\StoreCouponRequest;

class CouponsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Store a coupon
     * @param StoreCouponRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCouponRequest $request){

        $coupon = Coupon::findByCode(request('coupon'));

        return $request->save($coupon);

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(){
        session()->forget('coupon');
        return back();
    }
}
