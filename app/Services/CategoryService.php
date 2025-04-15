<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function listAll()
    {
        return cache()->remember('categories.all', now()->addMinutes(10), function () {
            return Category::select('id', 'name')->get();
        });
    }


    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
