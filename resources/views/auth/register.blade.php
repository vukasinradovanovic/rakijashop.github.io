@extends('layout.AuthLayout')
@section('main')
<main class="d-flex justify-content-center align-items-center vh-100 flex-column">
    <form action="{{ route('register') }}" method="POST" class=" LoginRegisterForm p-4">
        @csrf
        <h2 class="mb-4 text-capitalize">{{ __('auth.register') }}</h2>
        <div class="mb-3 w-100">
            <input type="text" name="name" placeholder="{{ __('auth.name') }}"
                class="form-control @error('name') ring-red @enderror" value="{{old(" name")}}">
            @error('name')
            <p class="error"> {{$message}}</p>
            @enderror

        </div>
        <div class="mb-3 w-100">

            <input type="email" name="email" placeholder="{{ __('auth.email') }}"
                class="form-control @error('email') ring-red @enderror" value="{{old(" email")}}">
            @error('email')
            <p class="error"> {{$message}}</p>
            @enderror
        </div>

        <!-- Password input with visibility toggle button -->
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
        <div class="mb-3 w-100">
            <input type="password" name="password_confirmation" placeholder="{{ __('auth.confirm-password') }}"
                class="form-control @error('password') ring-red @enderror">
        </div>
        <button class="btn btnPrimary w-100">{{ __('buttons.register') }}</button>
    </form>
    <div class="box p-3 mt-1">{{__('auth.haveAcc?')}}<a href="{{ route('login') }}" class="ms-1 text-success">{{
            __('buttons.login') }}</a></div>
</main>
@endsection