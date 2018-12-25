<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductToWishlistRequest extends FormRequest
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
            'product' => 'required|string|exists:products,slug'
        ];
    }

    public function save($product){
        auth()->user()->addToWishlist($product);

        if(request()->wantsJson()){
            return response(['msg' => $product->name . " " . __('front.added_to_your_wishlist')], 200);
        }

        return back();
    }
}
