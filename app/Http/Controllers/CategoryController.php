<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::all(),
            'user' => auth()->user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create', [
            'user' => auth()->user(),
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
                         ->with('success', 'Categoria cadastrada com sucesso!');
    }
}
