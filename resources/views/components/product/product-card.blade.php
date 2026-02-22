@props([
    'product',
    'showActions' => true,
])

@php
    // Ovde ćeš kasnije ubaciti pravu putanju slike proizvoda
    $productImage = asset('img/default-product.jpg');
@endphp

<article class="card productCard productCard--grid position-relative {{ $attributes->get('class') }}">
    <div class="productCard_img card-img-top position-relative">
        <img src="{{ $productImage }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100 object-fit-cover">
        <div class="productCard_imgOverlay overlay"></div>
    </div>

    <div class="card-body productCard_body">
        <h2 class="h6 card-title productCard_bodyTitle mb-2">{{ $product->name }}</h2>

        @if($product->description)
            <p class="card-text productCard_bodyDesc line-clamp-3 mb-2">{{ $product->description }}</p>
        @endif

        <div class="d-flex justify-content-between align-items-center productCard_bodyFooter mt-2">
            <span class="productCard_bodyPrice badge">{{ number_format($product->price, 2, ',', '.') }} RSD</span>
            <span class="productCard_bodyStock small text-muted">Lager: {{ $product->stock }}</span>
        </div>

        @if($showActions)
            <div class="d-flex justify-content-between align-items-center mt-3 productCard_actions">
                <a href="{{ route('product.show', $product) }}" class="btn btn-sm btn-outline-secondary productCard_actionsBtn">Detalji</a>
                <a href="{{ route('product.edit', $product) }}" class="btn btn-sm btnPrimary productCard_actionsBtn">Izmeni</a>
                <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger productCard_actionsBtn"
                            onclick="return confirm('Da li ste sigurni da želite da obrišete proizvod?')">
                        Obriši
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- Whole card clickable: open product show page --}}
    <a href="{{ route('product.show', $product) }}" class="stretched-link" aria-label="Prikaži proizvod {{ $product->name }}"></a>
</article>
