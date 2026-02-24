@props([
    'product',
    'showActions' => true,
])

{{-- Variables --}}
@php
    $productImage = asset('img/default-product.svg');
@endphp

<article class="productCard {{ $attributes->get('class') }}">
    <div class="productCard__media">
        <img src="{{ $productImage }}" alt="{{ $product->name }}" class="productCard__image">
        {{-- Status of product --}}
        <span class="productCard__badge">Status: {{ $product->getStatusNameById($product->status_id) }}</span>
    </div>

    <div class="productCard__body">
        <p class="productCard__eyebrow">Izdvajamo</p>
        <h3 class="productCard__title">{{ $product->name }}</h3>

        @if($product->description)
            <p class="productCard__text">{{ $product->description }}</p>
        @endif

        <div class="productCard__footer">
            <span class="productCard__price">{{ number_format($product->price, 2, ',', '.') }} RSD</span>
        </div>
    </div>

    <a href="{{ route('product.show', $product) }}" class="stretched-link" aria-label="Prikaži proizvod {{ $product->name }}"></a>
</article>
