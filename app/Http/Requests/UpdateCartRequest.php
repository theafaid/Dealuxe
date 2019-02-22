<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cart;

class UpdateCartRequest extends FormRequest
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
            'qnt'     => 'sometimes|integer|min:1',
        ];
    }

    public function save($product){
        Cart::session($this->user()->id)->update($product->id, [
            'quantity' => [
                'relative' => false,
                'value' => $this->qnt ?: 1
            ]
        ]);
    }
}
