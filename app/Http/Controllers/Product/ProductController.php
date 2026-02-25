<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\ImageProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('images')->orderByDesc('created_at')->paginate(12);

        return view('productPages.indexProductPage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productStatuses = ProductStatus::all();

        // Allow access to create form only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Morate biti ulogovani da biste dodali proizvod.');
        }

        return view('productPages.createProductPage', compact('productStatuses'));
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
                ->with('error', 'Morate biti ulogovani da biste dodali proizvod.');
        }

        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['status_id'])) {
            $defaultStatus = ProductStatus::where('id', 1)->first();
            $data['status_id'] = $defaultStatus->id;
        }

        $product = Product::create($data);
        $product->users()->syncWithoutDetaching([Auth::id()]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $image = ImageProduct::create(['img' => $imagePath]);

            $product->images()->sync([$image->id]);
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Proizvod je uspešno kreiran.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('images');

        return view('productPages.showProductPage', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productStatuses = ProductStatus::all();
        $product->load('images');

        return view('productPages.editProductPage', compact('product', 'productStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Ne diramo slug na update-u (onUpdate = false)
        unset($data['slug']);

        $product->update($data);

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
            ->with('success', 'Proizvod je uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $images = $product->images()->get();

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
            ->with('success', 'Proizvod je uspešno obrisan.');
    }
}
