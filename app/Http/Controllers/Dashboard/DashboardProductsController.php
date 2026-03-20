<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product\CategoryProducts;
use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use Illuminate\Http\Request;

class DashboardProductsController
{
    /**
     * Display product dashboard page.
     */
    public function index()
    {
        return view('dashboard.dashboardProduct.dashboardProducts');
    }

    /**
     * Search products for dashboard table.
     */
    public function search(Request $request)
    {
        $fields = $request->validate([
            'query' => ['nullable', 'string', 'max:120'],
        ]);

        $searchQuery = trim((string) ($fields['query'] ?? ''));

        if ($searchQuery === '') {
            return response()->json([
                'products' => [],
                'statuses' => ProductStatus::query()->orderBy('name')->get(['id', 'name']),
                'categories' => CategoryProducts::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
            ]);
        }

        $products = Product::query()
            ->with(['status:id,name', 'categories:id,name'])
            ->where('name', 'like', "%{$searchQuery}%")
            ->orWhere('slug', 'like', "%{$searchQuery}%")
            ->get();

        return response()->json([
            'products' => $products,
            'statuses' => ProductStatus::query()->orderBy('name')->get(['id', 'name']),
            'categories' => CategoryProducts::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Update selected product fields from dashboard table.
     */
    public function update(Request $request, int $id)
    {
        $fields = $request->validate([
            'price' => ['nullable', 'numeric', 'min:0'],
            'status_id' => ['nullable', 'integer', 'exists:product_statuses,id'],
            'category_id' => ['nullable', 'integer', 'exists:category_products,id'],
        ]);

        $product = Product::query()->with('categories')->find($id);

        if (!$product) {
            return response()->json(['message' => __('dashboard.products.product_not_found')], 404);
        }

        $update = [];

        if (array_key_exists('price', $fields)) {
            $update['price'] = $fields['price'];
        }

        if (array_key_exists('status_id', $fields)) {
            $update['status_id'] = $fields['status_id'];
        }

        if (!empty($update)) {
            $product->update($update);
        }

        if (array_key_exists('category_id', $fields)) {
            $product->categories()->sync(!empty($fields['category_id']) ? [(int) $fields['category_id']] : []);
        }

        return response()->json(['message' => __('dashboard.products.update_success')]);
    }
}
