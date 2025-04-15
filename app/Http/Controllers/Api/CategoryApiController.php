<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\PathItem(path="/api/v1/categories")
 *
 * @OA\Tag(
 *     name="Categorias",
 *     description="Gerenciamento de categorias de produtos"
 * )
 */
class CategoryApiController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/categories",
     *     summary="Listar todas as categorias",
     *     tags={"Categorias"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Categorias retornadas com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->service->listAll());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/categories",
     *     summary="Criar nova categoria",
     *     tags={"Categorias"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoria criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Categoria criada com sucesso.',
            'data' => $category,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/categories/{id}",
     *     summary="Obter detalhes de uma categoria",
     *     tags={"Categorias"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoria encontrada",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $category = $this->service->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        return response()->json($category);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/categories/{id}",
     *     summary="Atualizar uma categoria",
     *     tags={"Categorias"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoria atualizada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/v1/categories/{id}",
     *     summary="Excluir uma categoria",
     *     tags={"Categorias"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoria excluída com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $category = $this->service->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        $this->service->delete($category);

        return response()->json(['message' => 'Categoria excluída com sucesso.']);
    }
}
