<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\PathItem(path="/api/v1/products")
 *
 * @OA\Tag(
 *     name="Produtos",
 *     description="Gerenciamento de produtos"
 * )
 */
class ProductApiController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     summary="Listar todos os produtos",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *     )
     * )
     */
    public function index()
    {
        $products = $this->service->listAll();
        return response()->json($products);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/products",
     *     summary="Criar um novo produto",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     )
     * )
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Produto cadastrado com sucesso.',
            'data' => $product,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products/{id}",
     *     summary="Exibir detalhes de um produto",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do produto",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     )
     * )
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/products/{id}",
     *     summary="Atualizar um produto",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     )
     * )
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'integer|min:0',
            'price' => 'numeric|min:0',
            'category_id' => 'exists:categories,id',
            'sku' => "string|max:50|unique:products,sku,{$product->id}",
        ]);

        $updated = $this->service->update($product, $validated);
        return response()->json($updated);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/products/{id}",
     *     summary="Excluir um produto",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Produto excluído com sucesso"
     *     )
     * )
     */
    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(null, 204);
    }
}
