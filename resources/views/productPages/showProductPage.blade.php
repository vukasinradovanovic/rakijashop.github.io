@extends('layout.layout')

@section('main')
<section class="productPage productPage--show">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('product.index', ['locale' => app()->getLocale()]) }}" class="siteHero_ghost">&larr; {{
                __('product.show.back_to_list') }}</a>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-product.product-card :product="$product" :showActions="false" class="productCard--wide" />
            </div>
            <div class="col-12 col-md-6">
                <h1 class="productPage_title">{{ $product->name }}</h1>
                <p class="productPage_meta">{{ $product->getCategoryNamesAttribute() }}</p>

                {{-- Description --}}
                @if($product->description)
                <div class="mt-3">
                    <h2 class="productPage_subtitle">{{ __('product.show.description') }}</h2>
                    <p class="productPage_description">{{ $product->description }}</p>
                </div>
                @endif

                {{-- Add to Cart Form --}}
                <form action="{{ route('cart.store', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                    method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btnPrimary productPage_addToCart">
                        <i class="fa-solid fa-cart-plus me-2"></i>{{ __('cart.actions.add') }}
                    </button>
                </form>

                <p class="productPage_price">{{ number_format($product->price, 2, ',', '.') }} {{ __('product.currency')
                    }}</p>

                {{-- Buttons for product actions --}}
                @if(Auth::user() && Auth::user()->hasProduct($product->id) != null)
                <div class="productCard_actions">
                    <a href="{{ route('product.edit', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                        class="productCard_btn">{{ __('product.show.edit') }}</a>
                    <form
                        action="{{ route('product.destroy', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                        method="POST" class="productCard_delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="productCard_btn productCard_btn--danger">
                            {{ __('product.show.delete') }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
            {{-- Reviews --}}
            <div class="col-12 col-lg-6">
                <h3>{{ __('reviews.section_title') }}<span class="fs-3 ms-1">({{ $user->reviewsReceived->count()
                        }})</span></h3>
                <div class="row container p-0 m-0 pb-5">
                    @if ($user->reviewsReceived->count())
                    @foreach ($user->reviewsReceived()->latest()->take(4)->get() as $review)
                    <x-user.user-review-card :review="$review" />
                    @endforeach
                    @else
                    @if (auth()->check() && $ad->hasUser(auth()->id()))
                    <div class=" p-3 roudend border d-flex justify-content-between align-items-center">
                        <p class="text-secondary m-0">{{ __('reviews.empty_own') }}</p>
                        @auth
                        <button class="btn btnSecondary" data-bs-toggle="modal" data-bs-target="#reviewModal"><i
                                class="fa fa-plus"></i> {{ __('reviews.write') }}</button>
                        @endauth
                    </div>
                    @else
                    <div class=" p-2 roudend border d-flex justify-content-between align-items-center">
                        <p class="text-secondary m-0">{{ __('reviews.empty_user') }}</p>
                        @auth
                        <button class="btn btnSecondary" data-bs-toggle="modal" data-bs-target="#reviewModal"><i
                                class="fa fa-plus"></i> {{ __('reviews.write') }}</button>
                        @endauth
                    </div>
                    @endif
                    @endif
                    <div
                        class="d-flex justify-content-between @if (!$ad->users->first()->reviewsReceived->count()) d-none @endif">
                        @auth
                        <button type="button"
                            class="btn btnPrimary @if ($ad->hasUser(auth()->id())) d-none @endif"
                            data-bs-toggle="modal" data-bs-target="#reviewModal"><i class="fa fa-plus"></i> {{
                            __('reviews.write') }}</button>
                        @endauth
                        <a href="{{ route('reviews.show', ['locale' => app()->getLocale(), 'username' => $user->getUsername(), 'from' => url()->current()]) }}"
                            class="btnUnderline">{{ __('reviews.view_all') }}<i class="fa fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@auth
<div id="validation-errors" data-has-errors="{{ $errors->any() ? 'true' : 'false' }}"></div>
<x-user.review-modal :user="$user" />
@endauth
@endsection