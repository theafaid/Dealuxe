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
        return $this->user()->canCheckout();
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

        $cartTotal = $user->cartTotal($toDollar = false, $dollarSign = false);

        $customer = Customer::create([
            'email' => $user->email,
            'source' => $this->stripeToken
        ]);

        if($coupon = session('coupon')){
            // discount must be 100% if it was bigger than the cart grand total
            $discount = $coupon['discount'] >= $cartTotal ? $cartTotal : $coupon['discount'];
        }else{
            $discount = 0;
        }

//        Charge::create([
//            'customer' => $customer->id,
//            'amount' => $cartTotal - $discount,
//            'currency' => 'usd',
//            'metadata' => [
//                'content' => $content,
//                'quantity' => $user->cartItemsCount(),
//                'coupon' => $coupon['code'] ?: "no coupon",
//                'discount' => $discount
//            ],
//        ]);
//
//        session()->flash('payment_succeeded', 'success');
//
//        Cart::session($user->id)->clear();
//
//        session()->forget('coupon');
//
//        // record order
//        $table->unsignedInteger('user_id')->nullable();
//        $table->foreign('user_id')->references('id')->on('users')
//            ->onDelete('set null')->onUpdate('cascade');
//
//        $table->string('name_on_card');
//        $table->integer('discount')->default(0);
//        $table->string('coupon_code')->nullable();
//        $table->integer('total');
//        $table->string('payment_gateway')->default('stripe');
//        $table->boolean('shipped')->default(false);
//        $table->string('error')->nullable();
//        $table->timestamps();
//        // $user->newOrder();
//        Order::create([
//            'user_id' => $this->user()->id,
//            'name_on_card' => $customer->name_on_card,
//            'discount' => $discount
//        ]);
//
//        // foreach products
//        OrderProduct::create([
//            'order_id' =>
//        ]);
    }
}
