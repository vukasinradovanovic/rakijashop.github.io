<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
    ];

    // Relationship with Product model (many-to-many)
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_image', 'image_product_id', 'product_id')->withTimestamps();
    }
    public function hasProduct(int $productId): bool{
        return $this->products()->where('product_id', $productId)->exists();
    }
}
