@props([
    'product',
    'showActions' => true,
])

{{-- Variables --}}
@php
    $productImage = $product->main_image;
@endphp

<article class="productCard {{ $attributes->get('class') }}">
    <div class="productCard__media">
        <img src="{{ $productImage }}" alt="{{ $product->name }}" class="productCard__image">
        {{-- Status of product --}}
        <span class="productCard__badge">{{ $product->getCategoryNamesAttribute() }}</span>
    </div>

    <div class="productCard__body">
        <p class="productCard__eyebrow">{{ __('product.show.featured') }}</p>
        <h3 class="productCard__title">{{ $product->name }}</h3>

        @if($product->description)
            <p class="productCard__text">{{ $product->description }}</p>
        @endif

        <div class="productCard__footer">
            <span class="productCard__price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency') }}</span>
        </div>

        @if($showActions)
            <div class="productCard__actions position-relative z-2">
                <form action="{{ route('cart.store', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btnPrimary productCard__btn productCard__btn--cart">
                        <i class="fa-solid fa-cart-plus me-2"></i>{{ __('cart.actions.add') }}
                    </button>
                </form>
            </div>
        @endif
    </div>

    <a href="{{ route('product.show', $product) }}" class="stretched-link" aria-label="{{ __('product.show.show_product', ['name' => $product->name]) }}"></a>
</article>
