@extends('layout.AuthLayout')
@section('main')
<main class="d-flex justify-content-center align-items-center vh-100 flex-column">
    <form action="{{ route('login') }}" method="POST" class="LoginRegisterForm p-4">
        @csrf
        <h2 class="mb-4">{{ __('auth.login') }}</h2>

        <div class="mb-3 w-100">
            <input type="email" name="email" placeholder="{{ __('auth.email') }}"
                class="form-control @error('email') ring-red @enderror">
            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password input with show/hide functionality -->
        <div class="mb-2 w-100">
            <!-- ensure input-group does not wrap -->
            <div class="input-group flex-nowrap">
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
        <div class="form-group w-100 mb-2">
            <input type="checkbox" name="remember" id="remember"> <label for="remember">Zapamti me</label>
        </div>
        <button class="btn btnPrimary w-100">{{ __('buttons.login') }}</button>
    </form>
    <div class="box p-3 mt-1">{{__('auth.dontHaveAcc?')}}<a href="{{ route('register') }}" class="ms-1 text-success">{{
            __('buttons.register') }}</a></div>
</main>
@endsection