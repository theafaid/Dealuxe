<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ValidCategoryParent implements Rule
{
    protected $requestedCategory;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($requestedCategory = null)
    {
        $this->requestedCategory = $requestedCategory;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $category = Category::find($value);

        if(! $this->requestedCategory) {
            return $this->isParent($category);
        }

        return $this->isParent($category) && $this->parentNotTheSame($category);
    }

    /**
     * Check if the parent is not the requested category to update
     * @param $category
     * @return bool
     */
    protected function parentNotTheSame($category)
    {
        return $this->requestedCategory->id != $category->id;
    }

    /**
     * Check if category is parent category
     * @param $category
     * @return bool
     */
    protected function isParent($category)
    {
        return $category && $category->isParent();
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('site.you_selected_invalid_parent');
    }
}
