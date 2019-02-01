<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductToCartRequest;
use App\Http\Requests\UpdateCartRequest;
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

        if($product->hasCount($request->qnt)){
            return $request->save($product);
        }

        return response(['msg' => __('front.do_not_have_qnt')], 422);
    }


    /** 
     * Update Cart
     */
    public function update(UpdateCartRequest $request){
        
        $product = Product::whereSlug(request('product'))->first();

        if(! $product->hasCount($request->qnt)){
            return response(['msg' => __('front.do_not_have_qnt')], 422);
        }
        
        try{
            $request->save($product);
        }catch(\Exception $ex){
            return response(['msg' => $ex->getmessage()], 422);
        }

        return response(['msg' => __('front.cart_updated_successfully')]);
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

    /**
     * Remove an item from a cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(){
        $data = request()->validate(['product' => 'required|string|exists:products,slug']);

        $product = Product::whereSlug($data['product'])->first();

        Cart::session(auth()->id())->remove($product->id);

        if(request()->wantsJson()){
            return response(['msg' => $product->name . " " . __('front.removed_from_your_cart')], 200);
        }
        return back();
    }
}
