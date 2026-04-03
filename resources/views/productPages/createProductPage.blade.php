@extends('layout.layout')

@section('main')
{{-- Main section: create new product page --}}
<section class="productPage productPage--create">
    <div class="container">
        <form action="{{ route('product.store', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data"
            class="formGeneral row g-3">
            @csrf
            <h1 class="productPage_title mb-5">{{ __('product.form.create_title') }}</h1>

            {{-- Name of product --}}
            <div class="col-12 col-md-4">
                <label for="name" class="form-label">{{ __('product.form.name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control @error('name') ring-red @enderror" required>
                @error('name')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categories of product --}}
            <div class="col-12 col-md-4">
                <label for="category_id" class="form-label">{{ __('product.form.category') }}</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') ring-red @enderror">
                    <option value="">{{ __('product.form.choose_category') }}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
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
                <label for="price" class="form-label">{{ __('product.form.price') }}</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                    class="form-control @error('price') ring-red @enderror" required>
                @error('price')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description of product --}}
            <div class="col-12">
                <label for="description" class="form-label">{{ __('product.form.description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') ring-red @enderror">{{ old('description') }}</textarea>
                @error('description')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status of product --}}
            <div class="col-12">
                <label for="status_id" class="form-label">{{ __('product.form.status') }}</label>
                <select name="status_id" id="status_id" class="form-select @error('status_id') ring-red @enderror">
                    <option value="">{{ __('product.form.choose_status') }}</option>
                    @foreach($productStatuses as $status)
                    <option value="{{ $status->id }}" {{ (string) old('status_id') === (string) $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
                @error('status_id')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product image --}}
            <div class="col-12">
                <label for="image" class="form-label">{{ __('product.form.image') }}</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') ring-red @enderror">
                @error('image')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button for submitting form --}}
            <div class="col-12 d-flex gap-2 mt-3 productPage_formActions">
                <button type="submit" class="btn btnPrimary">{{ __('product.form.save') }}</button>
                <a href="{{ route('product.index', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-secondary">{{ __('product.form.cancel') }}</a>
            </div>
        </form>
    </div>
</section>
@endsection