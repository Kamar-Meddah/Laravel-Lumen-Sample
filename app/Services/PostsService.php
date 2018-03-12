<?php

namespace App\Services;

use App\Models\Post;

class PostsService
{

    public function all(): ?object
    {
        return Post::with('category')->get();
    }

    public function find(int $id): ?Post
    {
        return Post::with('category')->find($id);
    }

    public function delete(int $id): void
    {
        Post::destroy($id);
    }

}