<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Services\CategoryService;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return Inertia::render('Categories/Index', [
            'categories' => $this->service->listAll(),
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
        $this->service->create($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function destroy($id)
    {
        $category = $this->service->find($id);

        if ($category) {
            $this->service->delete($category);
            return redirect()->route('categories.index')
                ->with('success', 'Categoria excluída com sucesso!');
        }

        return redirect()->route('categories.index')
            ->with('error', 'Categoria não encontrada!');
    }

    public function edit($id)
    {
        $category = $this->service->find($id);

        return Inertia::render('Categories/Edit', [
            'category' => $category,
            'user' => auth()->user(),
        ]);
    }

    public function update(CategoryStoreRequest $request, $id)
    {
        $category = $this->service->find($id);

        if (!$category) {
            return redirect()->route('categories.index')
                ->with('error', 'Categoria não encontrada.');
        }

        $category->update($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }
}
