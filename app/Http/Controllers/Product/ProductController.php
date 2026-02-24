<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(12);

        return view('productPages.indexProductPage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Allow access to create form only for authenticated users
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Morate biti ulogovani da biste dodali proizvod.');
        }

        return view('productPages.createProductPage');
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
        // default value for is_active is true
        $data['is_active'] = $request->has('is_active')
            ? $request->boolean('is_active')
            : true;

        Product::create($data);

        return redirect()
            ->route('product.index')
            ->with('success', 'Proizvod je uspešno kreiran.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('productPages.showProductPage', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('productPages.editProductPage', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Ne diramo slug na update-u (onUpdate = false)
        unset($data['slug']);

        if ($request->has('is_active')) {
            $data['is_active'] = $request->boolean('is_active');
        }

        $product->update($data);

        return redirect()
            ->route('product.edit', $product)
            ->with('success', 'Proizvod je uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Proizvod je uspešno obrisan.');
    }
}
