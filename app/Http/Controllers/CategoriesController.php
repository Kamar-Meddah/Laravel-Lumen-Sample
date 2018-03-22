<?php

namespace App\Http\Controllers;

use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class CategoriesController extends Controller
{
    private $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
        $this->middleware('auth', ['only' => [
            'delete'
        ]]);
    }

    public function all()
    {
        $categories = $this->categoriesService->all();
        return response()->json($categories);
    }

    public function allPaginated(int $page)
    {
        return response()->json($this->categoriesService->allPaginated($page));
    }

    public function delete(int $id)
    {
        return response()->json(['deleted' => $this->categoriesService->delete($id)]);
    }

    public function update(Request $request)
    {
        $id = (int)$request->input('id');
        $title = $request->input('title');
        return response()->json(['updated' => $this->categoriesService->update($id, $title)]);
    }

    public function create(Request $request)
    {
        $title = $request->input('title');
        return response()->json(['created' => $this->categoriesService->create($title)]);
    }

}
