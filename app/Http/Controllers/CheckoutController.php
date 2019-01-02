<?php

namespace App\Http\Controllers;

use Stripe\{Charge, Customer};
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * View check out page with authenticated user cart data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $user = auth()->user();

        $cartTotal = $user->cartTotal(false, false);

        // discount must be 100% if it was bigger than the cart grand total
        if($coupon = session()->get('coupon')){
            $discount = $coupon['discount'] >= $cartTotal ? $cartTotal : $coupon['discount'];
        }else{
            $discount = 0;
        }

        $grandTotal = presentPrice($cartTotal - $discount);

        return view('checkout', [
            'cartItems'  => $user->cartItems(),
            'cartTotal'  => presentPrice($cartTotal),
            'discount'   => "-".presentPrice($discount),
            'coupon'     => $coupon,
            'grandTotal' => $grandTotal
        ]);
    }

    public function store(CheckoutRequest $request){

        $content = $request->user() ->cartItems()->map(function($item){
            return "product:" . $item['attributes']['product']['slug'] . " | qnt: ". $item['quantity'];
        })->values()->toJson();

        try{
            $request->persist($content);
        }catch(\Exception $ex){
            return response(['msg' => $ex->getMessage()], 422);
        }

        return response(['msg' => 'success'], 200);
    }
}
