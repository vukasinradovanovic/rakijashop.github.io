@extends('layout.layout')

@section('main')
<section class="pageSection min-height-100 d-flex align-items-center">
    <div class="container text-center">
        <p class="text-uppercase text-muted fw-semibold mb-2">{{ __('pages.errors.404.eyebrow') }}</p>
        <h1 class="pageSection_title mb-3">{{ __('pages.errors.404.title') }}</h1>
        <p class="text-muted mb-4">{{ __('pages.errors.404.message') }}</p>
        <a href="{{ route('index', ['locale' => app()->getLocale() ?: config('app.fallback_locale', 'en')]) }}" class="btn btnPrimary">
            <i class="fa-solid fa-house me-2"></i>{{ __('pages.errors.404.home') }}
        </a>
    </div>
</section>
@endsection