<?php

namespace App\Http\Controllers;

use App\Services\CommentsService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class CommentsController extends Controller
{
    private $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }

    public function post(Request $request)
    {
        $content = (string)$request->get('content');
        $user_id = (integer)$request->get('user_id');
        $response = $this->commentsService->post($content, $user_id);
        return response()->json(json_encode(['created' => $response]));
    }

    public function findAll(int $id){
        $comments = $this->commentsService->findAll($id);
        return response()->json($comments);
    }

}
