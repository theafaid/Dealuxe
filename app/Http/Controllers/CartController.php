<?php

namespace App\Http\Controllers;

use App\Product;

class CartController extends Controller
{
    public function index(){
        $mightLike = Product::mightLike()->get();
        return view('cart', ['mightLike' => $mightLike]);
    }
}
