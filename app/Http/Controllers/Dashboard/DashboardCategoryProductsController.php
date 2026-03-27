<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardCategoryProductsController
{
    /**
     * Display categories dashboard page.
     */
    public function index()
    {
        return view('dashboard.dashboardCategory.dashboardCategories');
    }

    /**
     * Search categories for dashboard table.
     */
    public function search(Request $request)
    {
        $fields = $request->validate([
            'query' => ['nullable', 'string', 'max:120'],
        ]);

        $searchQuery = trim((string) ($fields['query'] ?? ''));

        $categoriesQuery = CategoryProducts::query()->withCount('products');

        if ($searchQuery !== '') {
            $categoriesQuery->where(function ($builder) use ($searchQuery) {
                $builder->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('slug', 'like', "%{$searchQuery}%");
            });
        }

        $categories = $categoriesQuery
            ->orderBy('name')
            ->limit(80)
            ->get();

        return response()->json([
            'categories' => $categories->map(fn(CategoryProducts $category) => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'is_active' => (bool) $category->is_active,
                'products_count' => $category->products_count,
            ]),
        ]);
    }

    /**
     * Store new category from dashboard.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:category_products,name'],
            'slug' => ['nullable', 'string', 'max:140', 'alpha_dash', 'unique:category_products,slug'],
            'is_active' => ['required', 'boolean'],
        ]);

        $category = CategoryProducts::query()->create([
            'name' => trim($fields['name']),
            'slug' => $this->resolveUniqueSlug($fields['slug'] ?? null, $fields['name']),
            'is_active' => (bool) $fields['is_active'],
        ]);

        return response()->json([
            'message' => __('dashboard.category_products.create_success'),
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'is_active' => (bool) $category->is_active,
                'products_count' => 0,
            ],
        ], 201);
    }

    /**
     * Update selected category from dashboard table.
     */
    public function update(Request $request, int $id)
    {
        $category = CategoryProducts::query()->withCount('products')->find($id);

        if (!$category) {
            return response()->json(['message' => __('dashboard.category_products.category_not_found')], 404);
        }

        $fields = $request->validate([
            'name' => ['required', 'string', 'max:120', Rule::unique('category_products', 'name')->ignore($category->id)],
            'slug' => ['nullable', 'string', 'max:140', 'alpha_dash', Rule::unique('category_products', 'slug')->ignore($category->id)],
            'is_active' => ['required', 'boolean'],
        ]);

        $category->update([
            'name' => trim($fields['name']),
            'slug' => $this->resolveUniqueSlug($fields['slug'] ?? null, $fields['name'], $category->id),
            'is_active' => (bool) $fields['is_active'],
        ]);

        return response()->json([
            'message' => __('dashboard.category_products.update_success'),
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'is_active' => (bool) $category->is_active,
                'products_count' => $category->products_count,
            ],
        ]);
    }

    /**
     * Remove category from dashboard table.
     */
    public function destroy(int $id)
    {
        $category = CategoryProducts::query()->find($id);

        if (!$category) {
            return response()->json(['message' => __('dashboard.category_products.category_not_found')], 404);
        }

        $category->delete();

        return response()->json(['message' => __('dashboard.category_products.delete_success')]);
    }

    private function resolveUniqueSlug(?string $slugInput, string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug(trim((string) ($slugInput ?: $name)));
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'category';

        $slug = $baseSlug;
        $counter = 1;

        while (
            CategoryProducts::query()
                ->when($ignoreId !== null, fn($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
