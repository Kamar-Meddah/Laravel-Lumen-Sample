<?php

namespace App\Http\Controllers;

use App\Services\PostsService;
use Laravel\Lumen\Routing\Controller;

class PostsController extends Controller
{
    private $postsService;

    public function __construct(PostsService $postsService )
    {
        $this->postsService = $postsService;
    }

    public function all($page)
    {
        $posts = $this->postsService->all($page);
        return response()->json($posts);
    }

    public function allHome($page)
    {
        $posts = $this->postsService->allHome($page);
        return response()->json($posts);
    }

}
