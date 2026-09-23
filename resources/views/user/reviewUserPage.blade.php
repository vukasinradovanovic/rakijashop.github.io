@extends('layout.layout')

@section('main')
<section class="pageSection">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="pageSection_title mb-1">{{ __('pages.reviews.title', ['name' => $user->name]) }}</h1>
                <p class="text-muted mb-0">{{ __('pages.reviews.count', ['count' => $reviews->total()]) }}</p>
            </div>
            <a href="{{ $backUrl }}" class="btnUnderline">{{ __('pages.reviews.back') }}</a>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ request()->fullUrlWithQuery(['sort' => 1]) }}" class="btn btnSecondary">{{ __('pages.reviews.newest') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 2]) }}" class="btn btnSecondary">{{ __('pages.reviews.oldest') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 3]) }}" class="btn btnSecondary">{{ __('pages.reviews.highest_rating') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 4]) }}" class="btn btnSecondary">{{ __('pages.reviews.lowest_rating') }}</a>
        </div>

        <div class="row g-3">
            @forelse ($reviews as $review)
                <div class="col-12 col-md-6">
                    <x-user.user-review-card :review="$review" />
                </div>
            @empty
                <p class="text-secondary">{{ __('pages.reviews.empty') }}</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</section>
@endsection
