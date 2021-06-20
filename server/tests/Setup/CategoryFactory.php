<?php

namespace Tests\Setup;

use App\Models\Category;

class CategoryFactory
{
    protected $childrenCount = 0;
    protected $order = 1;
    protected $orderDirection = 'asc';

    /**
     * Make categories has a one child or more
     * @param int $count
     * @return $this
     */
    public function withChild($count = 1)
    {
        $this->childrenCount = $count;

        return $this;
    }

    public function withOrder($order, $direction = 'asc')
    {
        $this->order = $order;
        $this->orderDirection = $direction;

        return $this;
    }

    /**
     * Create a fake categories
     * @param bool $parent
     * @return mixed
     */
    public function create($count = null, $parent = true, $data = [])
    {
        // Create parent or child categories
        $category = factory(Category::class, $count > 1 ? $count : null)->create(array_merge([
            'parent_id' => ! $parent ? factory(Category::class)->create() : null,
            'order' => $this->order,

        ], $data));

        // Create children for the categories
        if($this->childrenCount && ($count == 1 || is_null($count))){
            $category->children()->save(
                factory(Category::class)->make()
            );
        }

        return $category;
    }

    /**
     * Handle a category before creating
     * @param $count
     * @param bool $parent
     * @return mixed
     */
    public function make($count = 1, $data = [])
    {
        $category = factory(Category::class, $count > 1 ? $count : null)->make(array_merge([
            'order' => $this->order,
        ], $data));

        return $category;
    }
}
