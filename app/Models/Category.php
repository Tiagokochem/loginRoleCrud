<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Category",
 *     title="Categoria",
 *     required={"name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Papelaria"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-15T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-15T00:00:00Z")
 * )
 */
class Category extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
