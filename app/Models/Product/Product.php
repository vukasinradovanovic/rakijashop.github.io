<?php

namespace App\Models\Product;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    // Generator for slugs
    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => false,
            ]
        ];
    }

     // In routs, this method uses slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relationship with User model (many-to-many)
    public function users() {
        return $this->belongsToMany(User::class, 'user_products', 'product_id', 'user_id');
    }
    public function hasUser(int $userId): bool{
        return $this->users()->where('user_id', $userId)->exists();
    }


}
