@extends('layout.layout')

@section('main')
{{-- Main section: edit existing product page --}}
<section class="productPage productPage--edit">
    <div class="container">
        @php
        $selectedCategoryId = old('category_id', optional($product->categories->first())->id);
        @endphp

        <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="formGeneral row g-3">
            @csrf
            @method('PUT')

            <h1 class="productPage_title mb-5">Izmeni proizvod</h1>


            {{-- Name of product --}}
            <div class="col-12 col-md-4">
                <label for="name" class="form-label">Naziv</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                    class="form-control @error('name') ring-red @enderror" required>
                @error('name')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categories of product --}}
            <div class="col-12 col-md-4">
                <label for="category_id" class="form-label">Kategorija</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') ring-red @enderror">
                    <option value="">-- Izaberi kategoriju --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $selectedCategoryId==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price of product --}}
            <div class="col-12 col-md-4">
                <label for="price" class="form-label">Cena</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01"
                    min="0" class="form-control @error('price') ring-red @enderror" required>
                @error('price')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description of product --}}
            <div class="col-12">
                <label for="description" class="form-label">Opis</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') ring-red @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product image --}}
            <div class="col-12">
                <label for="image" class="form-label">Slika proizvoda</label>
                <div class="mb-2">
                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="productPage_imagePreview">
                </div>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') ring-red @enderror">
                @error('image')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status of product --}}
            <div class="col-12">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select @error('status_id') ring-red @enderror">
                    @foreach($productStatuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id', $product->status_id) == $status->id ?
                        'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
                @error('status_id')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button for submitting form --}}
            <div class="col-12 d-flex gap-2 mt-3 productPage_formActions">
                <button type="submit" class="btn btnPrimary">Sačuvaj izmene</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Nazad na listu</a>
            </div>
        </form>
    </div>
</section>
@endsection