<?php

namespace App\Services;

use App\Models\Image;
use Exception;

class ImagesService
{
    public function create(string $title, int $id): bool
    {
        try {
            $image = new Image();
            $image->title = $title . '.jpg';
            $image->src = env('UPLOAD_PATH') . 'images/' . $title . '.jpg';
            $image->post_id = $id;
            return $image->saveOrFail();
        } catch (Exception $e) {
            return false;
        }
    }

}