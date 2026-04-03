<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\ImageProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductPosition;
use App\Models\Product\ProductStatus;
use App\Models\User\User;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index($locale, Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $categoryId = $request->input('category', '');
        $sort = $request->input('sort', 'newest');

        $query = Product::with(['images', 'users.userImg']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('category_products.id', $categoryId);
            });
        }

        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default      => $query->orderByDesc('created_at'),
        };

        $products   = $query->paginate(12)->withQueryString();
        $categories = CategoryProducts::where('is_active', true)->get();

        return view('productPages.indexProductPage', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale)
    {
        $productStatuses = ProductStatus::query()->orderBy('name')->get();
        $categories = CategoryProducts::where('is_active', true)->get();


        // Allow access to create form only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login', ['locale' => app()->getLocale()])
                ->with('error', __('product.flash.login_required'));
        }

        return view('productPages.createProductPage', compact('productStatuses', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Allow storing product only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login', ['locale' => app()->getLocale()])
                ->with('error', __('product.flash.login_required'));
        }

        $data = $request->validated();
        $categoryId = $data['category_id'] ?? null;
        unset($data['category_id']);
        unset($data['position_id']);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['status_id'])) {
            $defaultStatusId = ProductStatus::query()
                ->where('name', 'aktivan')
                ->value('id')
                ?? ProductStatus::query()->orderBy('id')->value('id');

            if (!$defaultStatusId) {
                return back()
                    ->withInput()
                    ->with('error', __('product.flash.status_missing'));
            }

            $data['status_id'] = $defaultStatusId;
        }

        $data['position_id'] = ProductPosition::query()
            ->where('slug', ProductPosition::SLUG_REGULAR)
            ->value('id')
            ?? ProductPosition::query()->orderBy('id')->value('id');

        $product = Product::create($data);
        $product->users()->syncWithoutDetaching([Auth::id()]);
        $product->categories()->sync($categoryId ? [$categoryId] : []);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $image = ImageProduct::create(['img' => $imagePath]);

            $product->images()->sync([$image->id]);
        }

        return redirect()
            ->route('product.index', ['locale' => app()->getLocale()])
            ->with('success', __('product.flash.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Product $product)
    {
        $product->load(['images', 'users.userImg']);
        $categories = CategoryProducts::where('is_active', true)->get();

        return view('productPages.showProductPage', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($locale, Product $product)
    {
        // Allow storing product only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login', ['locale' => app()->getLocale()])
                ->with('error', __('product.flash.login_required'));
        }

        $productStatuses = ProductStatus::query()->orderBy('name')->get();
        $canManagePosition = $this->canManagePosition();
        $productPositions = $canManagePosition ? ProductPosition::options() : [];
        $product->load('images');
        $categories = CategoryProducts::where('is_active', true)->get();

        return view('productPages.editProductPage', compact('product', 'productStatuses', 'productPositions', 'categories', 'canManagePosition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $categoryId = $data['category_id'] ?? null;
        unset($data['category_id']);

        if (!$this->canManagePosition()) {
            unset($data['position_id']);
        }

        unset($data['slug']);

        $product->update($data);
        $product->categories()->sync($categoryId ? [$categoryId] : []);

        // Handle image update
        if ($request->hasFile('image')) {
            $oldImage = $product->images()->first();

            $imagePath = $request->file('image')->store('products', 'public');
            $newImage = ImageProduct::create(['img' => $imagePath]);

            $product->images()->sync([$newImage->id]);

            if ($oldImage && $oldImage->products()->count() === 0) {
                Storage::disk('public')->delete($oldImage->img);
                $oldImage->delete();
            }
        }

        return redirect()
            ->route('product.show', ['locale' => app()->getLocale(), 'product' => $product])
            ->with('success', __('product.flash.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $images = $product->images()->get();
        $product->categories()->detach();

        $product->delete();

        foreach ($images as $image) {
            if (!$image->products()->exists()) {
                if (!empty($image->img) && Storage::disk('public')->exists($image->img)) {
                    Storage::disk('public')->delete($image->img);
                }

                $image->delete();
            }
        }

        return redirect()
            ->route('product.index', ['locale' => app()->getLocale()])
            ->with('success', __('product.flash.deleted'));
    }

    private function canManagePosition(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->hasRole('admin');
    }
}
