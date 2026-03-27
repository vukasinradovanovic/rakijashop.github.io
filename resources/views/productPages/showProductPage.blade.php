@extends('layout.layout')

@section('main')
<section class="productPage productPage--show">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="siteHero_ghost">&larr; {{ __('product.show.back_to_list') }}</a>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-product.product-card :product="$product" :showActions="false" class="productCard--wide" />
            </div>
            <div class="col-12 col-md-6">
                <h1 class="productPage_title">{{ $product->name }}</h1>
                <p class="productPage_meta">{{ $product->getCategoryNamesAttribute() }}</p>

                {{-- Description --}}
                @if($product->description)
                <div class="mt-3">
                    <h2 class="productPage_subtitle">{{ __('product.show.description') }}</h2>
                    <p class="productPage_description">{{ $product->description }}</p>
                </div>
                @endif

                {{-- Add to Cart Form --}}
                <form action="{{ route('cart.store', $product) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btnPrimary productPage_addToCart">
                        <i class="fa-solid fa-cart-plus me-2"></i>{{ __('cart.actions.add') }}
                    </button>
                </form>

                <p class="productPage_price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency') }}</p>

                {{-- Buttons for product actions --}}
                @if(Auth::user() && Auth::user()->hasProduct($product->id) != null)
                <div class="productCard__actions">
                    <a href="{{ route('product.edit', $product) }}" class="productCard__btn">{{ __('product.show.edit') }}</a>
                    <form action="{{ route('product.destroy', $product) }}" method="POST" class="productCard__delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="productCard__btn productCard__btn--danger">
                            {{ __('product.show.delete') }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection