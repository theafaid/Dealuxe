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
    public function index()
    {
        $categoryName = '';

        if($categorySlug = request('category')){
            $category =  Category::whereSlug($categorySlug)->firstOrFail();
            $categoryName = $category->name;
            $products = $category->products()->latest();
        }else{
            $products = Product::latest()->take(15);
        }

        $productsAfterSorting = $this->sortProducts($products, request('sortBy'));


        return view('shop', [
            'products' => $productsAfterSorting->paginate(),
            'categories' => \App\Category::all(),
            'categoryName' => $categoryName
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

    /**
     * Sort products by request
     * @param $products
     * @param null $sortBy
     * @return mixed
     */
    protected function sortProducts($products, $sortBy = null){

        $allowedFilters = ['price_low_high', 'price_high_low', 'featured'];

        if(is_null($sortBy) || !in_array($sortBy, $allowedFilters)) return $products;


        if($sortBy == 'price_low_high'){
            $products = $products->orderBy('price', 'asc');
        }elseif($sortBy == 'price_high_low') {
            $products = $products->orderBy('price', 'desc');
        }elseif($sortBy == 'featured'){
            $products = $products->where('featured', true);
        }else{
            return $products;
        }

        return $products;
    }
}
