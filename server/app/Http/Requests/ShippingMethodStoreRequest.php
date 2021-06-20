<?php

namespace App\Http\Requests;

class ShippingMethodStoreRequest extends BaseFormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'cities' => 'required|array|min:1',
            'cities.*' => 'numeric|exists:cities,id',
        ];
    }
}
