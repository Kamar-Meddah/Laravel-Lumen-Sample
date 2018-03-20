<?php

namespace App\Services;

use App\Models\Comment;
use Exception;

class CommentsService
{

    public function findAll(int $id)
    {
        return Comment::with('user')
            ->where('post_id', '=', $id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function delete(int $id): bool
    {
       return  (boolean)Comment::destroy($id);
    }

    public function post(string $content, int $post_id, int $user_id)
    {
        try {
            $comment = new Comment();
            $comment->content = $content;
            $comment->user_id = $user_id;
            $comment->post_id = $post_id;
            return $comment->saveOrFail();
        } catch (Exception $e) {
            return false;
        }
    }


}