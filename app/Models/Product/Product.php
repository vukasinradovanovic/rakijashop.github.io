<?php

namespace App\Models\Product;

use App\Models\User\User;
use App\Models\Product\CartItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'status_id',
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

    // Categories relationship (many-to-many)
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryProducts::class, 'product_category', 'product_id', 'category_id')->withTimestamps();
    }
    public function hasCategory(int $categoryId): bool{
        return $this->categories()->where('category_id', $categoryId)->exists();
    }
    public function getCategoryNamesAttribute(): string
    {
        return $this->categories->pluck('name')->implode(', ');
    }

    // status relationship with ProductStatus model (many-to-one)
    public function status(): BelongsTo
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }
    public function hasStatus(): bool
    {
        return $this->status()->exists();
    }

    // Images relationship (many-to-many)
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(ImageProduct::class, 'product_image', 'product_id', 'image_product_id')->withTimestamps();
    }

    public function getMainImageAttribute(): string
    {
        $image = $this->images->first();

        if ($image?->img) {
            return asset('storage/' . $image->img);
        }

        return asset('img/default-product.svg');
    }

    public static function getStatusNameById(int $statusId): ?string
    {
        return ProductStatus::query()
            ->whereKey($statusId)
            ->value('name');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    

}
