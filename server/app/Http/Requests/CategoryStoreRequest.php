<?php

namespace App\Http\Requests;

use App\Rules\ValidCategoryParent;

class CategoryStoreRequest extends BaseFormRequest
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
//        //get the base-64 from data
//        $base64_str = substr($this->image, strpos($this->image, ",") + 1);
//
//        //decode base64 string
//        $image = base64_decode($base64_str);
//
//        \Storage::disk('public')->put('categories/imgage.png', $image);
//
//        dd('done');
        return [
            'name' => 'required|string|max:25|unique:categories,name',
            'parent_id' => ['nullable', 'numeric', new ValidCategoryParent()],
            'order' => 'nullable|numeric|min:1|max:999',
            'image' => 'nullable',
        ];
    }
}
