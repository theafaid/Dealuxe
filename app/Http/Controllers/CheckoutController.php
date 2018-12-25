<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        return view('checkout', [
            'cartItems' => $user->cartItems(),
            'cartTotal' => $user->cartTotal()
        ]);
    }
}
