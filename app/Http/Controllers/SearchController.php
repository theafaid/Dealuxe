<?php

namespace App\Http\Controllers;

class SearchController extends Controller
{
    /**
     * Search for a specific product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(){

        if($query = request('q')){
            return view('search', [
                'title' => __("front.result_for {$query}")
            ]);
        }

        return redirect()->route('shop.index');
    }
}
