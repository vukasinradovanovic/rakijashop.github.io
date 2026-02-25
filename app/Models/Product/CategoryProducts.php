<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryProducts extends Model
{
    /** @use HasFactory<\Database\Factories\Product\CategoryProductsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    // Relationship with Product model (many-to-many)
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id')->withTimestamps();
    }
    public function hasProduct(int $productId): bool{
        return $this->products()->where('product_id', $productId)->exists();
    }
}
