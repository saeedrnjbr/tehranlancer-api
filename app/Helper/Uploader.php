<?php

namespace App\Helper;

class Uploader
{

    private static $instance = null;
    private $uploadDir;

    public function __construct()
    {
        $this->uploadDir = public_path("uploads");
        $this->thumbnail = $this->uploadDir . "/thumbnails/";
    }

    public static function _()
    {
        if (self::$instance == null) {
            self::$instance = new Uploader();
        }
        return self::$instance;
    }

    public function uploadImage($file, $name = "public")
    {
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid();
        $time = time();
        $original = $filename . '_original_' . $time . '.' . $extension;
        $file->move($this->uploadDir, $original);
        return $original;
    }

    public function removeImage($image)
    {
        return unlink($this->uploadDir . '/' . $image);
    }

  
}
