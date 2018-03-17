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

    public function delete(int $id): void
    {
        Comment::destroy($id);
    }

    public function post(string $content, int $id)
    {
        try {
            $comment = new Comment();
            $comment->content = $content;
            $comment->user_id = $id;
            $comment->post_id = $id;
            return $comment->save();
        } catch (Exception $e) {
            return false;
        }
    }


}