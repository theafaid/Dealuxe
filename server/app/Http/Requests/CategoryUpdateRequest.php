<?php

namespace App\Http\Requests;

use App\Rules\ValidCategoryParent;

class CategoryUpdateRequest extends BaseFormRequest
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
        $category = $this->route('category');

        return [
            'name' => 'required|string|max:25|unique:categories,name,'. $category->id,
            'parent_id' => ['nullable', 'numeric', new ValidCategoryParent($category)],
            'order' => 'nullable|numeric|min:1|max:999',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
