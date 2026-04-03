<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductPosition extends Model
{
    /** @use HasFactory<\Database\Factories\Product\ProductPositionFactory> */
    use HasFactory;

    public const SLUG_REGULAR = 'regular';
    public const SLUG_FEATURED = 'featured';
    public const SLUG_PREMIUM = 'premium';
    public const SLUG_TOP_OFFER = 'top-offer';
    public const NAME_FEATURED = 'Istaknut';

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'position_id');
    }

    public static function options(): array
    {
        return static::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
