<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Http\Requests\AddProductToWishlistRequest;

class WishlistController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display authenticated user wishlist
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('wishlist', [
            'wishlist' => auth()->user()->wishlist()->latest()->get()
        ]);
    }

    /**
     * Add a product to the authenticated user wishlist
     * @param AddProductToWishlistRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddProductToWishlistRequest $request){
        $product = Product::whereSlug(request('product'))->first();

        $cart = Cart::session(auth()->id());

        $cart->get($product->id) ? $cart->remove($product->id) : null;

        return $request->save($product);
    }
}
