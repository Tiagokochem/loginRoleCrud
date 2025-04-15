<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function listAll()
    {
        return Product::with('category')->get(); 
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
