@extends('layout.layout')

@section('main')
<section class="sectionBlock sectionBlock--light">
    <div class="container">
        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <x-product.product-card :product="$product" class="productCard--accent" />
            </div>
            @empty
            <p class="text-muted mb-0">Još uvek nema dostupnih proizvoda.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection