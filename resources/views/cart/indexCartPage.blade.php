@extends('layout.layout')

@section('main')
<section class="cartPage cartPage--index py-4 py-lg-5">
    <div class="container">
        <div class="cartPage_header d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="sectionBlock_eyebrow mb-1">{{ __('cart.page.eyebrow') }}</p>
                <h1 class="cartPage_title mb-0">{{ __('cart.page.title') }}</h1>
            </div>
            <div class="cartPage_summaryBadge">
                {{ __('cart.page.items_count', ['count' => $totalQuantity]) }}
            </div>
        </div>

        @if($items->count())
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="cartPage_list d-flex flex-column gap-3">
                        @foreach($items as $item)
                            @php
                                $product = $item->product;
                                $lineTotal = $item->quantity * ($product->price ?? 0);
                            @endphp

                            <article class="cartItem card border-0 shadow-sm">
                                <div class="card-body cartItem_body d-flex flex-column flex-md-row gap-3 align-items-md-center">
                                    <a href="{{ route('product.show', $product) }}" class="cartItem_media flex-shrink-0">
                                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="cartItem_image rounded-3">
                                    </a>

                                    <div class="cartItem_content flex-grow-1">
                                        <h2 class="cartItem_title h5 mb-1">
                                            <a href="{{ route('product.show', $product) }}" class="text-decoration-none text-reset">
                                                {{ $product->name }}
                                            </a>
                                        </h2>
                                        <p class="cartItem_meta mb-2">{{ $product->getCategoryNamesAttribute() }}</p>
                                        <p class="cartItem_price mb-0">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency') }}</p>
                                    </div>

                                    <div class="cartItem_controls d-flex flex-column flex-sm-row gap-2 align-items-sm-center">
                                        <form action="{{ route('cart.update', $product) }}" method="POST" class="d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <label for="cartQuantity{{ $product->id }}" class="visually-hidden">{{ __('cart.actions.quantity') }}</label>
                                            <input
                                                id="cartQuantity{{ $product->id }}"
                                                type="number"
                                                name="quantity"
                                                min="1"
                                                value="{{ $item->quantity }}"
                                                class="form-control cartItem_quantityInput"
                                            >

                                            <button type="submit" class="btn btn-outline-secondary cartItem_updateBtn">
                                                {{ __('cart.actions.update') }}
                                            </button>
                                        </form>

                                        <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger cartItem_removeBtn">
                                                {{ __('cart.actions.remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="cartItem_footer card-footer bg-transparent border-0 pt-0 pb-3 px-3 px-md-4 text-end">
                                    <strong>{{ __('cart.page.line_total') }}:</strong>
                                    {{ number_format($lineTotal, 2, ',', '.') }} {{ __('product.currency') }}
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <aside class="cartTotal card border-0 shadow-sm">
                        <div class="card-body">
                            <h2 class="h5 mb-3">{{ __('cart.page.summary_title') }}</h2>

                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('cart.page.items') }}</span>
                                <strong>{{ $totalQuantity }}</strong>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-3 mt-3">
                                <span>{{ __('cart.page.total') }}</span>
                                <strong>{{ number_format($totalPrice, 2, ',', '.') }} {{ __('product.currency') }}</strong>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        @else
            <div class="alert alert-light border cartPage_empty">
                {{ __('cart.page.empty') }}
            </div>
        @endif
    </div>
</section>
@endsection
