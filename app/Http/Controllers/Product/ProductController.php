<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\ImageProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\CategoryProducts;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index($locale)
    {
        $products = Product::with('images')->orderByDesc('created_at')->paginate(12);
        $categories = CategoryProducts::where('is_active', true)->get();

        return view('productPages.indexProductPage', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale)
    {
        $productStatuses = ProductStatus::all();
        $categories = CategoryProducts::where('is_active', true)->get();


        // Allow access to create form only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login')
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
                ->route('login')
                ->with('error', __('product.flash.login_required'));
        }

        $data = $request->validated();
        $categoryId = $data['category_id'] ?? null;
        unset($data['category_id']);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['status_id'])) {
            $defaultStatus = ProductStatus::where('id', 1)->first();
            $data['status_id'] = $defaultStatus->id;
        }

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
            ->route('product.index')
            ->with('success', __('product.flash.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Product $product)
    {
        $product->load('images');
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
                ->route('login')
                ->with('error', __('product.flash.login_required'));
        }
        
        $productStatuses = ProductStatus::all();
        $product->load('images');
        $categories = CategoryProducts::where('is_active', true)->get();

        return view('productPages.editProductPage', compact('product', 'productStatuses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $categoryId = $data['category_id'] ?? null;
        unset($data['category_id']);

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
            ->route('product.show', $product)
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
            ->route('product.index')
            ->with('success', __('product.flash.deleted'));
    }
}
