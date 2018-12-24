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

    /**
     * Remove an item from user wishlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(){
        request()->validate(['product' => 'required|string|exists:products,slug']);

        $product = Product::whereSlug(request('product'))->first();

        auth()->user()->removeFromWishlist($product);

        return back();
    }
    /**
     * Clear authenticated user wishlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(){
        $wishlist = auth()->user()->wishlist();

        $wishlist ? $wishlist->detach(): null;
        
        session()->flash('success', __("front.your_wishlist_has_cleared"));

        return back();
    }
}
