<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !! count(auth()->user()->cartItems());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon' => 'required|string|exists:coupons,code'
        ];
    }

    public function save($coupon){

        $cartTotal = auth()->user()->cartTotal($toDollar = false, $dollarSign = false);

        $coupon->addToSession($cartTotal);

        return redirect(route('checkout.index'))
            ->with('success', __('front.coupon_applied_successfully'));
    }
}
