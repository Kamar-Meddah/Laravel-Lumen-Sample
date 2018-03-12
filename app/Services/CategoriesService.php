<?php

namespace App\Services;

use App\Models\Category;

class CategoriesService
{

    public function all(): ?object
    {
        return Category::all();
    }

    public function find(int $id): ?Category
    {
        return Category::all()->find($id);
    }

    public function delete(int $id): void
    {
        Category::destroy($id);
    }

}