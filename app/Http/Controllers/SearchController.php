<?php

namespace App\Http\Controllers;

use App\Product;

class SearchController extends Controller
{
    public function index(){
        if($query = request('q')){
            $threads = Product::search($query)->get();

            if(request()->expectsJson()){
                return $threads;
            }

            return view('search', ['threads' => $threads]);
        }

        return view('products.index');
    }
}
