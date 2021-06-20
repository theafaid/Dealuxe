<?php

namespace App\Services\Categories;

use App\Services\Uploads\UploadService;
use App\Repositories\CategoryRepository;

class CategoryUpdateService
{
    protected $category;
    protected $uploader;
    /**
     * CategoryIndexService constructor.
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category, UploadService $uploader)
    {
        $this->category = $category;
        $this->uploader = $uploader;
    }

    /**
     * Store a new category
     * @param $data
     * @return mixed
     */
    public function update($category, $data)
    {
        isset($data['image']) ? $this->uploadImage($category, 'image') : null;

         $this->category->update($category, $data);
    }

    /**
     * Delete a category
     * @param $category
     */
    public function delete($category)
    {
        $category->image ? $this->deleteImage($category->image) : null;

        $this->category->delete($category);
    }

    /**
     * Upload the category image
     * @param $category
     * @param $filename
     * @return mixed
     */
    protected function uploadImage($category, $filename)
    {
        if($imagePath = $category->image) {
            $this->uploader->delete($imagePath);
        }

        return $this->uploader->upload($filename, 'categories');
    }

    /**
     * Delete the category image
     * @param $imagePath
     */
    public function deleteImage($imagePath)
    {
        $this->uploader->delete($imagePath);
    }

}
