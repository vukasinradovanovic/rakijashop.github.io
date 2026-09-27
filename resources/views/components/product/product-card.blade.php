@props([
    'product',
    'showActions' => true,
    'showPage' => false,
])

{{-- Variables --}}
@php
    $productImage = $product->main_image;
    $productOwner = $product->users->first();
    $ownerRating = !$showPage && $productOwner?->relationLoaded('reviewsReceived')
        ? $productOwner->reviewsReceived->avg(fn ($review) => $review->pivot->rating)
        : null;
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

        {{-- Author Information --}}
        <div class="productCard_author">
            <span
                class="productCard_authorAvatar"
                style="background-image: url('{{ $productOwner?->profile_image ?? asset('img/profile-picture.png') }}');"
                aria-hidden="true"></span>
            <div class="productCard_authorMeta">
                <span class="productCard_authorName">{{ $productOwner?->name ?? __('product.card.unknown_user') }}</span>
                @if($ownerRating !== null)
                    <span class="productCard_authorRating">
                        <i class="fa-solid fa-star" aria-hidden="true"></i>
                        {{ __('product.card.rating', ['rating' => number_format((float) $ownerRating, 1)]) }}
                    </span>
                @endif
            </div>
        </div>

        @if(!$showPage)
            <p class="productCard_text @if(!$product->description) productCard_text--empty @endif">{{ $product->description }}</p>
        @endif

        <div class="productCard_footer">
            <span class="productCard_price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency') }}</span>
        </div>

    </div>

    @if(!$showPage)
        <a href="{{ route('product.show', ['locale' => app()->getLocale(), 'product' => $product]) }}" class="stretched-link" aria-label="{{ __('product.show.show_product', ['name' => $product->name]) }}"></a>
    @endif
</article>
