<?php

namespace App\Http\Controllers;

use App\Category;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the Shop Products.
     * @return \Illuminate\Http\Response
     */
    public function index($categorySlug = null)
    {


        $category = $categorySlug ? Category::whereSlug($categorySlug)->firstOrFail() : null;


        if($category){
            $products = $category->products()->paginate();
        }else{
            $products = Product::inRandomOrder()->paginate();
        }


        return view('shop', [

            'products' => $products,
            'categories' => \App\Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display a single product page
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        /** check if user was put the product in his cart
         * so in this case we will return the quantity of the product
         * that user was stored
         **/

        $qnt = $product->inCart ? Cart::session(auth()->id())->get($product->id)->quantity : 1;

        return view('product', [
            'product'   => $product,
            'mightLike' => $product->mightLike(10)->get(),
            'qnt' => $qnt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
