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
        <span class="productCard__badge">Lager: {{ $product->stock }}</span>
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

        {{-- @if($showActions)
            <div class="productCard__actions">
                <a href="{{ route('product.edit', $product) }}" class="productCard__btn">Izmeni</a>
                <form action="{{ route('product.destroy', $product) }}" method="POST" class="productCard__delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="productCard__btn productCard__btn--danger"
                        onclick="return confirm('Da li ste sigurni da želite da obrišete proizvod?')">
                        Obriši
                    </button>
                </form>
            </div>
        @endif --}}
    </div>

    <a href="{{ route('product.show', $product) }}" class="stretched-link" aria-label="Prikaži proizvod {{ $product->name }}"></a>
</article>
