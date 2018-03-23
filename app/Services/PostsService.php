<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use URLify;

class PostsService
{

    public function all(int $page): ?object
    {
        return Post::with('category')
            ->where('user_id', "=", Auth::user()->id)
            ->orderBy('title', 'asc')
            ->paginate(10, ['id', 'title', 'created_at', 'category_id'], null, $page);
    }

    public function find(int $id): ?Post
    {
        return Post::with('category', 'user', 'images')->find($id);
    }

    public function delete(int $id): bool
    {
        try {
            $post = Post::find($id);
            if ($post->user_id === Auth::user()->id) {
                $this->deleteAllCommentsFromPost($id);
                $this->deleteAllImagesFromPost($id);
                return $post->delete();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    private function deleteAllCommentsFromPost(int $id): void
    {
        try {
            $comments = Comment::all()
                ->where('post_id', "=", $id);
            $comments->map(function ($comment) {
                $comment->delete();
            });
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    private function deleteAllImagesFromPost(int $id): void
    {
        try {
            $images = Image::all()
                ->where('post_id', "=", $id);
            $images->map(function ($image) {
                if (file_exists(App::basePath() . '\public\files\images\\' . $image->title)) {
                    unlink(App::basePath() . '\public\files\images\\' . $image->title);
                }
                $image->delete();
            });
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function last(int $page): ?object
    {
        $posts = Post::with('category')
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], null, $page);
        array_map(function ($post) {
            $post->content = substr($post->content, 0, 300);
        }, $posts->items());
        return $posts;
    }

    public function findByCategory(int $id, int $page): ?object
    {
        $posts = Post::with('category')
            ->orderByDesc('created_at')
            ->where('category_id', '=', $id)
            ->paginate(10, ['*'], null, $page);
        array_map(function ($post) {
            $post->content = substr($post->content, 0, 300);
        }, $posts->items());
        return $posts;
    }

    public function search(string $query, int $page): ?object
    {
        $posts = Post::with('category')
            ->where('title', 'like', '%' . $query . '%')
            ->paginate(10, ['*'], null, $page);
        array_map(function ($post) {
            $post->content = substr($post->content, 0, 300);
        }, $posts->items());
        return $posts;
    }

    public function create(string $title, string $content, int $id): ?int
    {
        try {
            $post = new Post();
            $post->title = $title;
            $post->slug = URLify::filter($title) != '' ? URLify::filter($title) : $title;
            $post->content = $content;
            $post->category_id = $id;
            $post->user_id = Auth::user()->id;
            $save = $post->saveOrFail();
            if ($save) {
                return $post->id;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }

}