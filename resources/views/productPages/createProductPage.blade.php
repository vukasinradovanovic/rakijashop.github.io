@extends('layout.layout')

@section('main')
{{-- Main section: create new product page --}}
<section class="productPage productPage--create">
    <div class="container">
        <h1 class="productPage__title mb-4">Kreiraj proizvod</h1>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="productForm row g-3">
            @csrf
            {{-- Name of product --}}
            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Naziv</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control @error('name') ring-red @enderror" required>
                @error('name')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price of product --}}
            <div class="col-12 col-md-6">
                <label for="price" class="form-label">Cena</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                       class="form-control @error('price') ring-red @enderror" required>
                @error('price')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description of product --}}
            <div class="col-12">
                <label for="description" class="form-label">Opis</label>
                <textarea name="description" id="description" rows="4"
                          class="form-control @error('description') ring-red @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categories of product --}}
            <div class="col-12">
                <label for="category_id" class="form-label">Kategorija</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') ring-red @enderror">
                    <option value="">-- Izaberi kategoriju --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product image --}}
            <div class="col-12">
                <label for="image" class="form-label">Slika proizvoda</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="form-control @error('image') ring-red @enderror">
                @error('image')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button for submitting form --}}
            <div class="col-12 d-flex gap-2 mt-3">
                <button type="submit" class="btn btnPrimary">Sačuvaj</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Otkaži</a>
            </div>
        </form>
    </div>
</section>
@endsection
