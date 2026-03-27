@extends('layout.layout')

@section('main')
<section class="productPage productPage--index">
    <div class="container">
        {{-- Search bar --}}
        <x-search.search-bar action="product.index" />

        <div class="productPage_header">
            <div>
                <p class="sectionBlock_eyebrow">{{ __('product.index.eyebrow') }}</p>
                <h1 class="productPage_title">{{ __('product.index.title') }}</h1>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="row g-4 align-items-start">
            {{-- Filter Form --}}
            <div class="col-12 col-md-4 col-lg-3 productPage_sidebar">
                <x-product.filter-form :categories="$categories" />
            </div>

            {{-- Product List --}}
            <div class="col-12 col-md-8 col-lg-9 productPage_content">
                @if($products->count())
                <div class="row g-4 productPage_grid">
                    @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-xl-4">
                        <x-product.product-card :product="$product" />
                    </div>
                    @endforeach
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