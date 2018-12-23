<?php

namespace App\Http\Controllers;

use App\Product;

class WelcomePageController extends Controller
{
    public function index(){

        $products = Product::inRandomOrder()->take(8)->get();

        return view('welcome', ['products' => $products]);
    }
}
