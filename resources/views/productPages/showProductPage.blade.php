@extends('layout.layout')

@section('main')
<section class="productPage productPage_show">
    <div class="mb-3">
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Nazad na listu</a>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <x-product.product-card :product="$product" :showActions="false" class="w-100" />
        </div>
        <div class="col-12 col-md-6">
            <h1 class="h3 mb-3">{{ $product->name }}</h1>
            <p class="mb-2"><strong>Cena:</strong> {{ number_format($product->price, 2, ',', '.') }} RSD</p>
            <p class="mb-2"><strong>Stanje na lageru:</strong> {{ $product->stock }}</p>
            <p class="mb-2"><strong>Status:</strong> {{ $product->is_active ? 'Aktivan' : 'Neaktivan' }}</p>

            @if($product->description)
                <div class="mt-3">
                    <h2 class="h5 mb-2">Opis</h2>
                    <p class="productPage_show-desc">{{ $product->description }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
