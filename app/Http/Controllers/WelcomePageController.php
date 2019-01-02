<?php

namespace App\Http\Controllers;

use App\Product;

class WelcomePageController extends Controller
{
    /**
     * Show welcome page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){


        if(count($featured = Product::where('featured', true)->take(8)->get()) >= 8){
            $products = $featured;
        }else{
            $products = Product::latest()->take(8)->get();
        }


        return view('welcome',
            [
                'products' => $products
            ]);
    }
}
