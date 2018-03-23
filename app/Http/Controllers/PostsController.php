<?php

namespace App\Http\Controllers;

use App\Services\ImagesService;
use App\Services\PostsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpFoundation\File\File;

class PostsController extends Controller
{
    private $postsService;
    private $imagesService;


    public function __construct(PostsService $postsService, ImagesService $imagesService)
    {
        $this->postsService = $postsService;
        $this->imagesService = $imagesService;
        $this->middleware('auth', ['only' => [
            'all', 'delete', 'insert', 'update'
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

    public function update(Request $request)
    {
        $res = false;
        if (Auth::user()->role === 'admin') {
            $title = $request->get('title');
            $content = $request->get('content');
            $category_id = (integer)$request->get('category');
            $id = (integer)$request->get('id');
            $res = $this->postsService->update($title, $content, $category_id, $id);
            if ($res) {
                if ($request->hasFile('files')) {
                    array_map(function (File $file) use ($id) {
                        if (explode("/", $file->getMimeType())[0] === 'image' && $file->getSize() < 2097152) {
                            $unique = uniqid();
                            $r = $this->imagesService->create($unique, $id);
                            if ($r) {
                                $file->move(App::basePath() . '\public\files\images', $unique . '.jpg');
                            }
                        }
                    }, $request->file('files'));
                }
            }
        }
        return response()->json(['updated' => $res]);
    }

}
