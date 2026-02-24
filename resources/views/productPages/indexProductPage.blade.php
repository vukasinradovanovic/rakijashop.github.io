@extends('layout.layout')

@section('main')
<section class="productPage productPage_index">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 m-0">Proizvodi</h1>
    </div>

    @if($products->count())
        <div class="row g-4 productPage_grid">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-lg-4">
                    <x-product.product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-muted">Trenutno nema proizvoda.</p>
    @endif
</section>
@endsection
