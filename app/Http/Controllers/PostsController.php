<?php

namespace App\Http\Controllers;

use App\Services\PostsService;
use Laravel\Lumen\Routing\Controller;

class PostsController extends Controller
{
    private $postsService;


    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
        $this->middleware('auth', ['only' => [
            'all', 'delete'
        ]]);

    }

    public function all(int $page)
    {
        $posts = $this->postsService->all($page);
        return response()->json($posts);
    }

    public function delete(int $id)
    {
        return response()->json(['deleted' => $this->postsService->delete((integer)$id)]);
    }

    public function last(int $page)
    {
        $posts = $this->postsService->last($page);
        return response()->json($posts);
    }

    public function lastByCatgory(int $id, int $page)
    {
        $posts = $this->postsService->findByCategory($id, $page);
        return response()->json($posts);
    }

    public function search(string $query, int $page)
    {
        $posts = $this->postsService->search($query, $page);
        return response()->json($posts);
    }

    public function find(int $id)
    {
        $post = $this->postsService->find($id);
        return response()->json($post);
    }

}
