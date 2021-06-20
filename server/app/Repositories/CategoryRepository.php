<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get all parents categories loaded with its children
     * @return mixed
     */
    public function parents()
    {
        return $this->category->with('children')
            ->ordered()
            ->parents()
            ->get();
    }

    /**
     * Store a new category
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $category = $this->category->create($data);

        return $category->load('children');
    }

    /**
     * Update a category
     * @param $data
     * @return bool
     */
    public function update($category, $data)
    {
        $category->update($data);
    }

    /**
     * Delete a category
     * @param $category
     */
    public function delete($category)
    {
        $category->delete();
    }
}
