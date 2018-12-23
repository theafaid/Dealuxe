<?php

namespace App\Http\Controllers;

use App\Product;

class WelcomePageController extends Controller
{
    public function index(){

        $products = Product::mightLike()->get();

        return view('welcome', ['products' => $products]);
    }
}
