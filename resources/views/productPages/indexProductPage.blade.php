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

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-3">
                <x-product.filter-form :categories="$categories" />
            </div>

            <div class="col-12 col-lg-9">
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