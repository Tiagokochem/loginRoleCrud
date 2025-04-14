<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->listAll();
        return response()->json($products);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $this->service->create($request->validated());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'integer|min:0',
            'price' => 'numeric|min:0',
            'category' => 'string|max:100',
            'sku' => "string|max:50|unique:products,sku,{$product->id}",
        ]);

        $updated = $this->service->update($product, $validated);
        return response()->json($updated);
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(null, 204);
    }
}
