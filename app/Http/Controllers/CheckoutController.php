<?php

namespace App\Http\Controllers;

use Stripe\{Charge, Customer};

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
        return view('checkout', [
            'cartItems' => $user->cartItems(),
            'cartTotal' => $user->cartTotal()
        ]);
    }

    public function store(){
        $contents = auth()->user()->cartItems()->map(function($item){
            return "product:" . $item['attributes']['product']['slug'] . " | qnt: ". $item['quantity'];
        })->values()->toJson();

        try{
            $customer = Customer::create([
                'email' => auth()->user()->email,
                'source' => request('stripeToken')
            ]);

            Charge::create([
                'customer' => $customer->id,
                'amount' => substr(auth()->user()->cartTotal(), 1) * 100,
                'currency' => 'usd',
                'metadata' => [
                    'content' => $contents,
                    'quantity' => auth()->user()->cartItemsCount()
                ],
            ]);
        }catch(\Exception $ex){
            return back()->with('failed', $ex->getMessage());
        }
    }
}
