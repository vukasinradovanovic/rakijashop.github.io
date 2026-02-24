@extends('layout.layout')

@section('main')
<section class="productPage productPage--index">
    <div class="container">
        <div class="productPage__header">
            <div>
                <p class="sectionBlock__eyebrow">Ponuda</p>
                <h1 class="productPage__title">Naša kolekcija</h1>
            </div>
            <a href="{{ route('product.create') }}" class="btn btnPrimary">Dodaj proizvod</a>
        </div>

        @if($products->count())
            <div class="row g-4 productPage__grid">
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
    </div>
</section>
@endsection
