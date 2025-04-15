<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->listAll());
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Categoria criada com sucesso.',
            'data' => $category,
        ], 201);
    }

    public function destroy($id): JsonResponse
    {
        $category = $this->service->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        $this->service->delete($category);

        return response()->json(['message' => 'Categoria excluída com sucesso.']);
    }

    public function show($id): JsonResponse
    {
        $category = $this->service->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        return response()->json($category);
    }

    public function update(CategoryStoreRequest $request, $id): JsonResponse
    {
        $category = $this->service->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        $category->update($request->validated());

        return response()->json([
            'message' => 'Categoria atualizada com sucesso.',
            'data' => $category
        ]);
    }
}
