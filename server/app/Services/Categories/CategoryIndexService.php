<?php

namespace App\Services\Categories;

use App\Repositories\CategoryRepository;

class CategoryIndexService
{
    protected $category;

    /**
     * CategoryIndexService constructor.
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * A list of parent categories with it's children
     * @return mixed
     */
    public function handle($categories, $wantsJson = true)
    {
        return $wantsJson ? $categories : $this->toViewResponse($categories);
    }

    public function categories()
    {
        return $this->category->parents();
    }

    /**
     * It returns a view with categories data
     * @param $categories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function toViewResponse($categories)
    {
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

}
