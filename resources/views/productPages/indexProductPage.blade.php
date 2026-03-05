@extends('layout.layout')

@section('main')
<section class="productPage productPage--index">
    <div class="container">
        <div class="productPage_header">
            <div>
                <p class="sectionBlock_eyebrow">{{ __('product.index.eyebrow') }}</p>
                <h1 class="productPage_title">{{ __('product.index.title') }}</h1>
            </div>
        </div>

<<<<<<< HEAD
        <div class="productPage_layout">

            <aside class="productPage_sidebar">
                <x-product.filter-form
                    :categories="$categories"
                    :selected-category="request('category', '')"
                    :selected-sort="request('sort', 'newest')"
                    :search-query="request('search', '')"
                />
            </aside>

            <div class="productPage_content">
                @if($products->count())
                    <div class="row g-4 productPage_grid">
                        @foreach($products as $product)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <x-product.product-card :product="$product" />
                            </div>
                        @endforeach
=======
        <div class="mb-4">
            <x-product.filter-form :categories="$categories" />
        </div>

        @if($products->count())
            <div class="row g-4 productPage_grid">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <x-product.product-card :product="$product" />
>>>>>>> copilot/remove-responsive-sass-section
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <p class="text-muted">{{ __('product.index.empty') }}</p>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection


