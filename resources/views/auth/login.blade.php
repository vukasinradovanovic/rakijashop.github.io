@extends('layout.AuthLayout')
@section('main')
<main class="authPage">
    <div class="authPage__card">
        <h2 class="authPage__title">{{ __('auth.login') }}</h2>
        <p class="authPage__subtitle">Prijavi se i nastavi gde si stao.</p>

        <form action="{{ route('login') }}" method="POST" class="authPage__form">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('auth.email') }}</label>
                <input type="email" name="email" placeholder="{{ __('auth.email') }}"
                    class="form-control @error('email') ring-red @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('auth.pass') }}</label>
                <div class="input-group flex-nowrap authPage__password">
                    <input type="password" name="password" placeholder="{{ __('auth.pass') }}"
                        class="form-control passwordInput @error('password') ring-red @enderror"
                        aria-label="{{ __('auth.pass') }}">
                    <button type="button" class="btn btn-outline-secondary passwordSeeButton" tabindex="-1"
                        title="{{ __('Show password') }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="intended" value="{{ url()->previous() }}">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Zapamti me</label>
            </div>

            <button class="btn btnPrimary w-100">{{ __('buttons.login') }}</button>
        </form>

        <p class="authPage__switch">{{__('auth.dontHaveAcc?')}}
            <a href="{{ route('register') }}" class="authPage__link">{{ __('buttons.register') }}</a>
        </p>
    </div>
</main>
@endsection