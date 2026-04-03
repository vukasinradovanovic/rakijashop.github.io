@props([
    'product',
    'showActions' => true,
])

{{-- Variables --}}
@php
    $productImage = $product->main_image;
    $productOwner = $product->users->first();
@endphp

<article class="productCard {{ $attributes->get('class') }}">
    <div class="productCard_media">
        <img src="{{ $productImage }}" alt="{{ $product->name }}" class="productCard_image">
        {{-- Status of product --}}
        <span class="productCard_badge">{{ $product->getCategoryNamesAttribute() }}</span>

        {{-- Add to Cart Button --}}
        @if($showActions)
            <form action="{{ route('cart.store', ['locale' => app()->getLocale(), 'product' => $product]) }}" method="POST" class="productCard_addToCartAction position-absolute bottom-0 end-0 m-3 z-2">
                @csrf
                <button
                    type="submit"
                    class="btn productCard_addToCartIcon"
                    aria-label="{{ __('cart.actions.add') }}"
                >
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </form>
        @endif
    </div>

    <div class="productCard_body">
        <h3 class="productCard_title">{{ $product->name }}</h3>

        <div class="productCard_author">
            <span
                class="productCard_authorAvatar"
                style="background-image: url('{{ $productOwner?->profile_image ?? asset('img/profile-picture.png') }}');"
                aria-hidden="true"></span>
            <div class="productCard_authorMeta">
                <span class="productCard_authorName">{{ $productOwner?->name ?? __('product.card.unknown_user') }}</span>
            </div>
        </div>

        @if($product->description)
            <p class="productCard_text">{{ $product->description }}</p>
        @endif

        <div class="productCard_footer">
            <span class="productCard_price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency') }}</span>
        </div>

    </div>

    <a href="{{ route('product.show', ['locale' => app()->getLocale(), 'product' => $product]) }}" class="stretched-link" aria-label="{{ __('product.show.show_product', ['name' => $product->name]) }}"></a>
</article>
