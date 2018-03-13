<?php

namespace App\Services;

use App\Models\Post;

class PostsService
{

    public function all(int $page): ?object
    {
        return Post::with('category')
            ->paginate(10, ['id', 'title', 'created_at', 'category_id'], null, $page);
    }

    public function find(int $id): ?Post
    {
        return Post::with('category')
            ->find($id);
    }

    public function delete(int $id): void
    {
        Post::destroy($id);
    }

    public function allHome(int $page): ?object
    {
        $posts = Post::with('category')
            ->paginate(10, ['*'], null, $page);
        array_map(function ($post) {
            $post->content = substr($post->content, 0, 100);
        }, $posts->items());
        return $posts;
    }

}