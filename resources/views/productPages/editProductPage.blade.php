@extends('layout.layout')

@section('main')
{{-- Main section: edit existing product page --}}
<section class="productPage productPage_edit">
    <h1 class="h3 mb-4">Izmeni proizvod</h1>

    {{-- Form: update product --}}
    <form action="{{ route('product.update', $product) }}" method="POST" class="productForm productForm_edit row g-3">
        @csrf
        @method('PUT')

        {{-- Field: product name --}}
        <div class="col-12 col-md-6">
            <label for="name" class="form-label">Naziv</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                   class="form-control @error('name') ring-red @enderror" required>
            @error('name')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Field: product price --}}
        <div class="col-12 col-md-6">
            <label for="price" class="form-label">Cena</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                   class="form-control @error('price') ring-red @enderror" required>
            @error('price')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Field: product stock quantity --}}
        <div class="col-12 col-md-6">
            <label for="stock" class="form-label">Stanje na lageru</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                   class="form-control @error('stock') ring-red @enderror" required>
            @error('stock')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Field: product description --}}
        <div class="col-12">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" rows="4"
                      class="form-control @error('description') ring-red @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Toggle: product active status --}}
        <div class="col-12 d-flex align-items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-label m-0">Aktivan proizvod</label>
        </div>

        {{-- Actions: submit and back buttons --}}
        <div class="col-12 d-flex gap-2 mt-3">
            <button type="submit" class="btn btnPrimary">Sačuvaj izmene</button>
            <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Nazad na listu</a>
        </div>
    </form>
</section>
@endsection
