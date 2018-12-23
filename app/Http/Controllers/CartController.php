<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductToCartRequest;
use App\Product;
use Cart;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show cart page
     * It includes [Might like products - Cart items]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('cart',
            [
                'mightLike' => Product::mightLike()->get(),
                'cartItems' => auth()->user()->cartItems()
            ]);
    }

    /**
     * Store a product into cart
     * @param ProductToCartRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductToCartRequest $request){

        $product = Product::whereSlug(request('product'))->first();

        return $request->save($product);
    }

    /**
     * Clear authenticated user cart
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function clear(){
        Cart::session(auth()->id())->clear();
        session()->flash('success', __('front.shopping_cart_has_been_emptied'));
        return redirect(route('cart.index'));
    }
}
