<?php

namespace App\Services\Uploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadBase64Service
{
    protected $storage, $request;

    /**
     * UploadService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Upload a file into local storage
     * @param $filename
     * @param $path
     * @return mixed
     */
    public function upload($filename, $path)
    {
        if(is_array($this->request[$filename])) {
            return $this->uploadMultipleFiles($this->request->file($filename), $path);
        }

        return $this->uploadSingleFile($this->request->$filename, $path);
    }

    /**
     * Delete a file from local storage
     * @param $filePath
     */
    public function delete($filePath)
    {
        if(Storage::has($filePath)) Storage::delete($filePath);
    }

    /**
     * Upload a single file in local storage
     * @param $file
     * @param $path
     * @return mixed
     */
    protected function uploadSingleFile($file, $path) {
        $base64_str = substr($file, strpos($file, ",") + 1);

        $fileName = uniqid("categories_") . ".png";

        Storage::disk('public')->put($path = "categories/{$fileName}", base64_decode($base64_str));

        return $path;
    }

    /**
     * Upload a multiple files in local storage
     * @param $files
     * @param $path
     * @return false|string
     */
    protected function uploadMultipleFiles($files, $path)
    {
        foreach($files as $file) {
            $data[] = $this->uploadSingleFile($file, $path);
        }

        return json_encode($data);
    }
}