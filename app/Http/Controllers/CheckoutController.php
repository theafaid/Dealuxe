<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('checkout');
    }
}
