<?php

namespace App\Http\Requests;

use App\Mail\OrderCreated;
use App\OrderProduct;
use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;
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

    /**
     * First the customer will checkout by the payment gateway
     * then we will create a record in orders table for the customer
     * after this we will create a new record in order_product table
     * when the 3 points done > Just we will send mail to the customer that
     * new order has been created by him
     * then clear the coupon session if it exists and user cart
     * then decrease the quantity of all the product in the cart
     * will be cleared
     * @return string
     */
    public function persist(){

        $user = $this->user();
        // user cart total
        $cartTotal = $user->cartTotal($toDollar = false, $dollarSign = false);

        // check for a coupon and a get the discount
        if($coupon = session('coupon')){
            // discount must be 100% if it was bigger than the cart grand total
            $discount = $coupon['discount'] >= $cartTotal ? $cartTotal : $coupon['discount'];
        }else{
            $discount = 0;
        }

        $grandTotal = $cartTotal - $discount;

        if($this->customerCheckout($user, $grandTotal, $coupon, $discount)){
           $order = $this->recordInOrdersTables($user, $grandTotal, $coupon, $discount);
            if($order){
                $this->sendSuccessMailToCustomer($user, $order, $grandTotal);
            }
            $this->decreaseQuantities($user->cartItems());
        }

        $this->forgetSession($user);
    }

    /**
     * Record the order in orders table
     * @param $user
     * @param $grandTotal
     * @param $coupon
     * @param $discount
     * @return mixed
     */
    private function recordInOrdersTables($user, $grandTotal, $coupon, $discount){
        $orderData = [
            'user_id' => $this->user()->id,
            'discount' => $discount,
            'coupon_code' => $coupon['code'] ?: null,
            'total' => $grandTotal
        ];

        $order = $user->newOrder($orderData);

        foreach($user->cartItems() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['attributes']['product']['id'],
                'quantity' => $item['quantity']
            ]);
        }

        return $order;
    }
    /**
     * Stripe Checkout
     * @param $user
     * @param $grandTotal
     * @param $coupon
     * @param $discount
     * @return bool
     */
    private function customerCheckout($user, $grandTotal, $coupon, $discount){
        $customer = Customer::create([
            'email' => $user->email,
            'source' => $this->stripeToken
        ]);

        Charge::create([
            'customer' => $customer->id,
            'amount' => $grandTotal,
            'currency' => 'usd',
            'metadata' => [
                'content' => $this->getMetaData($user),
                'quantity' => $user->cartItemsCount(),
                'coupon' => $coupon['code'] ?: "no coupon",
                'discount' => $discount
            ],
        ]);

        session()->flash('payment_succeeded', 'success');

        return true;
    }
    /**
     * Get the meta data that will send to the payment gateway
     * @param $user
     * @return mixed
     */
    private function getMetaData($user){
        return $user->cartItems()->map(function($item){
            return "product:" . $item['attributes']['product']['slug'] . " | qnt: ". $item['quantity'] . "<br>";
        })->values()->toJson();
    }

    /**
     * Send a mail to the customer with his checkout information
     * @param $user
     * @param $order
     * @param $grandTotal
     */
    private function sendSuccessMailToCustomer($user, $order, $grandTotal){
        Mail::to($user->email)->send(new OrderCreated($order, $grandTotal));
    }


    /**
     * @param $items
     * Decrease the quantities for every product
     */
    private function decreaseQuantities($items){

        collect($items)->map(function($item){
            $product = Product::find($item['attributes']['product']['id']);
            $product->update(['quantity' => $product->quantity - $item['quantity']]);

        })->filter();
    }

    /**
     * Clear authenticated user cart - coupon session
     * @param $user
     */
    private function forgetSession($user){
        Cart::session($user->id)->clear();

        if(session()->has('coupon')){
            session()->forget('coupon');
        }
    }
}
