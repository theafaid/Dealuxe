<?php

namespace App\Services\Categories;

use App\Services\Uploads\UploadBase64Service;
use App\Services\Uploads\UploadService;
use App\Repositories\CategoryRepository;

class CategoryStoreService
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
    public function handle($data)
    {
        isset($data['image']) ? $data['image'] = $this->uploadImage('image') : null;

        return $this->category->store($data);
    }

    /**
     * Upload the category image
     * @param $filename
     * @return mixed
     */
    protected function uploadImage($filename)
    {
        return (new UploadBase64Service(request()))->upload($filename, 'categories');

//        return $this->uploader->upload($filename, 'categories');
    }

}
