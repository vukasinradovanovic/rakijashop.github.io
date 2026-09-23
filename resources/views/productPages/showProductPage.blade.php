@extends('layout.layout')

@section('main')
<section class="productPage productPage--show">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('product.index', ['locale' => app()->getLocale()]) }}" class="siteHero_ghost">&larr; {{
                __('product.show.back_to_list') }}</a>
        </div>

        <div class="productPage_hero">
            <div class="productPage_media">
                <x-product.product-card :product="$product" :showActions="false" class="productCard--wide" />
            </div>
            <div class="productPage_details">
                <h1 class="productPage_title">{{ $product->name }}</h1>
                <p class="productPage_meta">{{ $product->getCategoryNamesAttribute() }}</p>

                <div class="productPage_specs" aria-label="{{ __('product.show.specifications') }}">
                    <div class="productPage_spec">
                        <span class="productPage_specLabel">{{ __('product.show.type') }}</span>
                        <strong>{{ $product->getCategoryNamesAttribute() ?: __('product.show.not_available') }}</strong>
                    </div>
                    <div class="productPage_spec">
                        <span class="productPage_specLabel">{{ __('product.show.volume') }}</span>
                        <strong>{{ $product->volume_ml }} ml</strong>
                    </div>
                    <div class="productPage_spec">
                        <span class="productPage_specLabel">{{ __('product.show.alcohol') }}</span>
                        <strong>{{ number_format((float) $product->alcohol_percentage, 2, ',', '.') }}%</strong>
                    </div>
                </div>

                {{-- Owner Actions --}}
                @if(Auth::user() && Auth::user()->hasProduct($product->id))
                <div class="productPage_ownerActions">
                        <p class="productPage_ownerLabel"><i class="fa-solid fa-sliders me-2"></i>{{ __('product.show.actions') }}</p>
                    <div class="productPage_ownerButtons">
                        <a href="{{ route('product.edit', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                            class="productCard_btn"><i class="fa-solid fa-pen-to-square me-2"></i>{{ __('product.show.edit') }}</a>
                        <form action="{{ route('product.destroy', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                            method="POST" class="productCard_delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="productCard_btn productCard_btn--danger">
                                <i class="fa-solid fa-trash-can me-2"></i>{{ __('product.show.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <div class="productPage_purchase">
                    <p class="productPage_price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency')
                        }}</p>
                    <form action="{{ route('cart.store', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                        method="POST">
                    @csrf
                    <button type="submit" class="btn btnPrimary productPage_addToCart">
                        <i class="fa-solid fa-cart-plus me-2"></i>{{ __('cart.actions.add') }}
                    </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Description --}}
        @if($product->description)
        <div class="productPage_descriptionBlock">
            <p class="productPage_sectionEyebrow">{{ __('product.show.description') }}</p>
            <h2 class="productPage_subtitle">{{ __('product.show.description') }}</h2>
            <p class="productPage_description">{{ $product->description }}</p>
        </div>
        @endif

        <div class="productPage_reviews">
            <div class="productPage_reviewsHeader">
                <div>
                    <p class="productPage_sectionEyebrow">{{ __('reviews.section_title') }}</p>
                    <h2 class="productPage_subtitle">{{ __('reviews.section_title') }}<span class="productPage_reviewsCount">{{ $user->reviewsReceived->count() }}</span></h2>
                </div>
                <div class="productPage_reviewsActions">
                    @auth
                    @if (!$product->hasUser(auth()->id()))
                    <button type="button" class="btn btnPrimary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        <i class="fa fa-plus me-2"></i>{{ __('reviews.write') }}
                    </button>
                    @endif
                    @endauth
                    <a href="{{ route('reviews.show', ['locale' => app()->getLocale(), 'username' => $user->getUsername(), 'from' => url()->current()]) }}" class="btnUnderline">
                        {{ __('reviews.view_all') }}<i class="fa fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            @if ($user->reviewsReceived->count())
            <div class="productPage_reviewsGrid">
                @foreach ($user->reviewsReceived()->latest()->take(4)->get() as $review)
                <x-user.user-review-card :review="$review" />
                @endforeach
            </div>
            @else
            <div class="productPage_reviewsEmpty">
                <i class="fa-regular fa-star"></i>
                <p>{{ auth()->check() && $product->hasUser(auth()->id()) ? __('reviews.empty_own') : __('reviews.empty_user') }}</p>
            </div>
            @endif
                </div>
    </div>
</section>
@auth
<div id="validation-errors" data-has-errors="{{ $errors->any() ? 'true' : 'false' }}"></div>
<x-user.review-modal :user="$user" />
@endauth
@endsection