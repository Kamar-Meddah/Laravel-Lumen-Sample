<?php

namespace App\Http\Controllers;

use App\Services\CommentsService;
use App\Services\ImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;

class ImagesController extends Controller
{
    private $imagesService;


    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
        $this->middleware('auth', ['only' => [
            'delete'
        ]]);
    }

    public function delete(int $id)
    {
        if (Auth::user()->role === 'admin') {
            return response()->json(['deleted' => $this->imagesService->delete($id)]);
        }
        return response()->json(['deleted' => false]);
    }


}
