<?php

namespace App\Services;

use App\Models\Image;
use Exception;
use Illuminate\Support\Facades\App;

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

    public function delete(int $id): bool
    {
        try {
            $image = Image::find($id);
            if (file_exists(App::basePath() . '\public\files\images\\' . $image->title)) {
                unlink(App::basePath() . '\public\files\images\\' . $image->title);
            }
            return $image->delete();

        } catch (Exception $e) {
            return false;
        }
    }

}