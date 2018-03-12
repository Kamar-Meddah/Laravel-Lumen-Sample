<?php

namespace App\Http\Controllers;

use App\Services\CategoriesService;
use App\Services\PostsService;
use Laravel\Lumen\Routing\Controller;

class PostsController extends Controller
{
    private $postsService;

    public function __construct(PostsService $postsService )
    {
        $this->postsService = $postsService;
    }

    public function all()
    {
        $posts = $this->postsService->all();
        return response()->json($posts);
    }

}
