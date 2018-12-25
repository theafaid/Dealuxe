<?php

namespace App\Http\Requests;

use Cart;
use Illuminate\Foundation\Http\FormRequest;

class ProductToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => 'required|string|exists:products,slug',
            'qnt'     => 'sometimes|integer|min:1|max:15',
        ];
    }

    public function save($product){
        Cart::session(auth()->id());

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $this->qnt ?: 1,
            'attributes' => [
                'product' => $product
            ]
        ]);


        if(request()->wantsJson()){
            return response(['msg' => $product->name . " " . __('front.added_to_your_cart')], 200);
        }

        session()->flash('success', $product->name . " " . __('front.added_to_your_cart'));

        return redirect(route('cart.index'));
    }
}
