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

    public function store(StoreCouponRequest $request){


        $coupon = Coupon::findByCode(request('coupon'));

        return $request->save($coupon);

    }

    public function destroy(){
        session()->forget('coupon');
        return back();
    }
}
