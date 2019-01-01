<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Stripe\{Charge, Customer};
use Cart;
class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeToken' => 'required|string'
        ];
    }

    public function persist($content){

        $user = $this->user();
        
        $customer = Customer::create([
            'email' => $user->email,
            'source' => $this->stripeToken
        ]);

        Charge::create([
            'customer' => $customer->id,
            'amount' => substr($user->cartTotal(), 1) * 100,
            'currency' => 'usd',
            'metadata' => [
                'content' => $content,
                'quantity' => $user->cartItemsCount()
            ],
        ]);

        session()->flash('payment_succeded', 'success');

        Cart::session($user->id)->clear();
    }
}
