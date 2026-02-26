@extends('layout.AuthLayout')
@section('main')
<main class="authPage">
    <div class="authPage_card">
        <h2 class="authPage_title text-capitalize">{{ __('auth.register') }}</h2>
        <p class="authPage_subtitle">{{ __('auth.register-subtitle') }}</p>

        <form action="{{ route('register') }}" method="POST" class="authPage_form">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('auth.name') }}</label>
                <input type="text" name="name" placeholder="{{ __('auth.name') }}"
                    class="form-control @error('name') ring-red @enderror" value="{{ old('name') }}">
                @error('name')
                <p class="error"> {{$message}}</p>
                @enderror

            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('auth.email') }}</label>

                <input type="email" name="email" placeholder="{{ __('auth.email') }}"
                    class="form-control @error('email') ring-red @enderror" value="{{ old('email') }}">
                @error('email')
                <p class="error"> {{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('auth.pass') }}</label>
                <div class="input-group flex-nowrap authPage_password">
                    <input type="password" name="password" placeholder="{{ __('auth.pass') }}"
                        class="form-control passwordInput @error('password') ring-red @enderror"
                        aria-label="{{ __('auth.pass') }}">
                        <button type="button" class="btn btn-outline-secondary passwordSeeButton" tabindex="-1"
                            title="{{ __('auth.show-password') }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('auth.confirm-password') }}</label>
                <input type="password" name="password_confirmation" placeholder="{{ __('auth.confirm-password') }}"
                    class="form-control @error('password') ring-red @enderror">
            </div>
            <button class="btn btnPrimary w-100">{{ __('buttons.register') }}</button>
        </form>
        <p class="authPage_switch">{{__('auth.haveAcc?')}}<a href="{{ route('login') }}" class="authPage_link">{{
                __('buttons.login') }}</a></p>
    </div>
</main>
@endsection