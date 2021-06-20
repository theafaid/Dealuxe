<?php

namespace App\Http\Requests;

class ProductStoreRequest extends BaseFormRequest
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
            'description' => 'required|string',
            'main_image' => 'required|image|mimes:jpg,jpeg,png',
            'additional_images' => 'array',
            'additional_images.*' => 'image|mimes:jpg,jpeg,png',
            'variations' => 'required|array|min:1',
            'variations.*' => 'array',
            'variations.*.type' => 'required|string|max:255',
            'variations.*.name' => 'required|string|max:255',
            'variations.*.price' => 'numeric',
            'variations.*.quantity' => 'required|numeric',
            'variations.*.order' => 'required|numeric',
        ];
    }
}
