<?php

namespace App\Http\Requests;

use App\Rules\ValidCity;

class AddressStoreRequest extends BaseFormRequest
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
            'address_1' => 'required|string|max:255',
            'postal_code' => 'string|max:10 ',
            'city_id' => ['required', new ValidCity],
            'default' => 'required|in:1,0',
        ];
    }
}
