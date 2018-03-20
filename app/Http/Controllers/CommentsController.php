<?php

namespace App\Http\Controllers;

use App\Services\CommentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;

class CommentsController extends Controller
{
    private $commentsService;


    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
        $this->middleware('auth', ['only' => [
            'delete', 'post'
        ]]);
    }

    public function post(Request $request)
    {
        $content = (string)$request->get('content');
        $user_id = (integer)$request->get('user_id');
        $post_id = (integer)$request->get('post_id');
        $response = (bool)$this->commentsService->post($content, $post_id, $user_id);
        return response()->json(['created' => $response]);
    }

    public function findAll(int $id)
    {
        $comments = $this->commentsService->findAll($id);
        return response()->json($comments);
    }

    public function delete(int $id)
    {
        if (Auth::user()->role === 'admin') {
            return response()->json(['deleted' => $this->commentsService->delete($id)]);
        }
        return response()->json(['deleted' => false]);
    }


}
