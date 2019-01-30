<?php

namespace App\Http\Controllers;

use App\Filters\ShopFilters;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the Shop Products.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('q')){
            return redirect()->route('search', ['q' => request('q')]);
        }

        $data = $this->getProducts();

        return view('shop', [
            'products' => $data['products']->paginate(),
            'categoryName' => $data['categoryName']
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
        // The qnt of the product will be according to the cart
        $qnt = $product->inCart ? Cart::session(auth()->id())->get($product->id)['quantity'] : 1;

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

    /**
     * Filter products then sort it
     * @return array
     */
    protected function getProducts(){

        if($categorySlug = request('category')){
            $data = ShopFilters::productsByCategory($categorySlug);
            $categoryName = $data['categoryName'];
            $products = $data['products'];
        }else{
            $categoryName = __('front.our_products');
            $products = ShopFilters::getRandProducts();
        }

        $products = ShopFilters::sortProducts($products, request('sortBy'));

        return [
            'categoryName' => $categoryName,
            'products' => $products
        ];
    }
}
