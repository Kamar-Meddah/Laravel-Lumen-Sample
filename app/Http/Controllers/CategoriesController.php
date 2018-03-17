<?php

namespace App\Http\Controllers;

use App\Services\CategoriesService;
use Laravel\Lumen\Routing\Controller;

class CategoriesController extends Controller
{
    private $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function all()
    {
        $categories = $this->categoriesService->all();
        return response()->json($categories);
    }

}
