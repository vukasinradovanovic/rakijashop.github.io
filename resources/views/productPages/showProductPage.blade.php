@extends('layout.layout')

@section('main')
<section class="productPage productPage--show">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="siteHero__ghost">&larr; Nazad na listu</a>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-product.product-card :product="$product" :showActions="false" class="productCard--wide" />
            </div>
            <div class="col-12 col-md-6">
                <h1 class="productPage__title">{{ $product->name }}</h1>
                <p class="productPage__meta">Stanje: {{ $product->stock }} | Status: {{ $product->is_active ? 'Aktivan' : 'Neaktivan' }}</p>
                <p class="productPage__price">{{ number_format($product->price, 2, ',', '.') }} RSD</p>

                @if($product->description)
                    <div class="mt-3">
                        <h2 class="productPage__subtitle">Opis</h2>
                        <p class="productPage__description">{{ $product->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
