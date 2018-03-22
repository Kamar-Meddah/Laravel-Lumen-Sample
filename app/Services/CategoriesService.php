<?php

namespace App\Services;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use URLify;

class CategoriesService
{

    public function all(): ?object
    {
        return Category::all();
    }

    public function allPaginated(int $page): ?object
    {
        return Category::orderBy('title', 'asc')->paginate(10, ['*'], null, $page);

    }

    public function find(int $id): ?Category
    {
        return Category::all()->find($id);
    }

    public function delete(int $id): bool
    {
        if (Auth::user()->role === 'admin') {
            try {
                return Category::destroy($id);
            } catch (Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update(int $id, string $string)
    {
        try {
            if (Auth::user()->role === 'admin') {
                $category = Category::find($id);
                $category->slug = URLify::filter($string);
                $category->title = $string;
                return $category->saveOrFail();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function create(string $string)
    {
        try {
            if (Auth::user()->role === 'admin') {
                $category = new Category();
                $category->slug = URLify::filter($string);
                $category->title = $string;
                return $category->saveOrFail();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

}