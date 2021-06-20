<?php

namespace App\Http\Requests;

use App\App\Cart;
use Illuminate\Validation\Rule;
use App\Rules\ValidShippingMethod;

class OrderStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! app(Cart::class)->isEmpty();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => [
                'required', Rule::exists('addresses', 'id')->where(function ($builder) {
                    $builder->where('user_id', $this->user()->id);
                })
            ],

            'shipping_method_id' => [
                'required', new ValidShippingMethod($this->address_id)
            ]
        ];
    }
}
