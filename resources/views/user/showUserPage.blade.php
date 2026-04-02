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

        @if (session('status'))
        <div class="alert alert-success userProfilePage_alert userProfilePage_alert--success" role="status">
            {{ session('status') }}
        </div>
        @endif

        @auth
        @if ((int) auth()->id() === (int) $user->id)
        <div class="userProfilePage_section userProfilePage_section--form mb-5">
            <h2 class="userProfilePage_editFormTitle">{{ __('pages.user_profile.form.title') }}</h2>

            <form action="{{ route('user.update', ['locale' => app()->getLocale(), 'user' => $user->username]) }}"
                method="POST" class="formGeneral userProfilePage_editForm mt-3">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label" for="profile-name">{{ __('pages.user_profile.form.name') }}</label>
                    <input id="profile-name" type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="form-control @error('name') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.form.name_placeholder') }}">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="profile-email">{{ __('pages.user_profile.form.email') }}</label>
                    <input id="profile-email" type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="form-control @error('email') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.form.email_placeholder') }}">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btnPrimary">{{ __('pages.user_profile.form.submit') }}</button>
            </form>
        </div>
        @endif
        @endauth

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