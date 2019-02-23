<?php

namespace App\Http\Controllers;

use App\Product;

class SearchController extends Controller
{
    public function index(){

        if(request()->has('q')){
            $products = Product::search($query = request('q'))->paginate(20);

            if(request()->expectsJson()){
                return $products;
            }

            return view('search', [
                'title' => __("front.result_for {$query}")
            ]);
        }

        return redirect()->route('shop.index');
    }
}
