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
            'qnt'     => 'required|integer|min:1|max:15',
        ];
    }

    public function save($product){
        Cart::session(auth()->id());

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => request('qnt')
        ]);

        session()->flash('success', $product->name . " " . __('front.added_to_your_cart'));

        return redirect(route('cart.index'));
    }
}
