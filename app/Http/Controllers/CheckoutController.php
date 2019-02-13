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

        if(! $user->hasCompletedProfile()){
            session()->flash('error', __('front.please_complete_your_profile_first'));
            return redirect(route('profile.index'));
        }

        $cartTotal = $user->cartTotal(false, false);
        if(! $cartTotal > 0) {
            return redirect(route('shop.index'));
        }

        $discountData = $this->checkCoupon($cartTotal);
        $grandTotal = presentPrice($cartTotal - $discountData['discount']);

        return view('checkout', [
            'cartItems'  => $user->cartItems(),
            'cartTotal'  => presentPrice($cartTotal),
            'discount'   => "-".presentPrice($discountData['discount']),
            'coupon'     => $discountData['coupon'],
            'grandTotal' => $grandTotal
        ]);
    }

    /**
     * Check for a coupon request then return the discount
     * @param $cartTotal
     * @return array
     */
    public function checkCoupon($cartTotal){
        if($coupon = session()->get('coupon')){
            // discount must be 100% if it was bigger than the cart grand total
            $discount = $coupon['discount'] >= $cartTotal ? $cartTotal : $coupon['discount'];
        }else{
            $discount = 0;
        }
        return ['discount' => $discount, 'coupon' => $coupon];
    }

    /**
     * @param CheckoutRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|string
     */
    public function store(CheckoutRequest $request){

        try{
            return $request->persist();
        }catch(\Exception $ex){
            return response(['msg' => $ex->getMessage()], 422);
        }
    }
}
