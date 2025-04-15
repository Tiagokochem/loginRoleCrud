<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function listAll()
    {
        return Category::all();
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
