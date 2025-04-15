<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Product",
 *     title="Produto",
 *     required={"name", "price", "sku", "quantity", "category_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Caneta azul"),
 *     @OA\Property(property="description", type="string", example="Caneta esferográfica azul com ponta fina"),
 *     @OA\Property(property="quantity", type="integer", example=100),
 *     @OA\Property(property="price", type="number", format="float", example=3.5),
 *     @OA\Property(property="sku", type="string", example="CAN-AZUL-001"),
 *     @OA\Property(property="category_id", type="integer", example=2),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-15T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-15T00:00:00Z")
 * )
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'sku',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }
}
