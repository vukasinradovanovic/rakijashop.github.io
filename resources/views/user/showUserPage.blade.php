@extends('layout.layout')

@section('main')
<section class="sectionBlock sectionBlock--light">
    <div class="container userProfilePage">
        <div class="userProfilePage_header d-flex align-items-center gap-3 mb-4">
            <span class="userHeader_img" style="background-image: url('{{ $user->profile_image }}');"></span>
            <div>
                <h1 class="pageSection_title mb-1">{{ $user->name }}</h1>
                <p class="text-muted mb-0">&#64;{{ $user->username }}</p>
            </div>
        </div>

        <div class="userProfilePage_section userProfilePage_section--products">
            <h2 class="userProfilePage_productsTitle">{{ __('pages.user_profile.products_title') }}</h2>

            <div class="row g-4 userProfilePage_productsGrid mt-1">
                @forelse($products as $product)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-product.product-card :product="$product" class="productCard--accent" />
                </div>
                @empty
                <p class="text-muted mb-0">{{ __('pages.user_profile.empty_products') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection