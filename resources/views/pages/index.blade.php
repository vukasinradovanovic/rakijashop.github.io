@extends('layout.layout')

@section('main')
    {{-- Hero section --}}
    <x-sections.hero />

    <section class="sectionBlock sectionBlock--light">
        <div class="container">
            <div class="sectionBlock_header">
                <div>
                    <p class="sectionBlock_eyebrow">{{ __('pages.home.eyebrow') }}</p>
                    <h2 class="sectionBlock_title">{{ __('pages.home.title') }}</h2>
                    <p class="sectionBlock_subtitle">{{ __('pages.home.subtitle') }}</p>
                </div>
                <a href="{{ route('product.index') }}" class="sectionBlock_link">{{ __('pages.home.see_all') }} <i class="fa fa-arrow-right"></i></a>
            </div>

            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <x-product.product-card :product="$product" class="productCard--accent" />
                    </div>
                @empty
                    <p class="text-muted mb-0">{{ __('pages.home.empty_products') }}</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="sectionBlock sectionBlock--muted">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="storyCard">
                        <p class="storyCard_eyebrow">{{ __('pages.home.story_eyebrow') }}</p>
                        <h3 class="storyCard_title">{{ __('pages.home.story_title') }}</h3>
                        <p class="storyCard_text">
                            {{ __('pages.home.story_text') }}
                        </p>
                        <ul class="storyCard_list">
                            <li class="storyCard_listItem"><i class="fa fa-check"></i> {{ __('pages.home.story_item_1') }}</li>
                            <li class="storyCard_listItem"><i class="fa fa-check"></i> {{ __('pages.home.story_item_2') }}</li>
                            <li class="storyCard_listItem"><i class="fa fa-check"></i> {{ __('pages.home.story_item_3') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="storyCard_media">
                        <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1200&q=80" alt="{{ __('pages.home.story_image_alt') }}" class="storyCard_image">
                        <div class="storyCard_badge">{{ __('pages.home.story_badge') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection