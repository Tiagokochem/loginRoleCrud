<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category');
    
        // Filtros dinâmicos
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        $products = $query->get()->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'description' => $p->description,
                'quantity' => $p->quantity,
                'price' => $p->price,
                'sku' => $p->sku,
                'category_name' => $p->category?->name,
            ];
        });
    
        return Inertia::render('Products/Index', [
            'products' => $products,
            'user' => auth()->user(),
            'filters' => $request->only(['name', 'category_id', 'min_price', 'max_price']),
            'categories' => \App\Models\Category::select('id', 'name')->get(),
        ]);
    }
    


    public function store(ProductStoreRequest $request)
    {
        $product = $this->service->create($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function show(Product $product)
    {
        return Inertia::render('Products/Show', [
            'product' => $product->load('category'),
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sku' => "required|string|max:50|unique:products,sku,{$product->id}",
        ]);

        $this->service->update($product, $validated);

        return redirect()->route('products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product->load('category'),
            'categories' => \App\Models\Category::select('id', 'name')->get(),
            'user' => auth()->user(),
        ]);
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);

        return redirect()->route('products.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
