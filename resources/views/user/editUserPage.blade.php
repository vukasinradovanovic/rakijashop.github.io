@extends('layout.layout')

@section('main')
<section class="sectionBlock sectionBlock--light">
    <div class="container userProfilePage">
        @auth
        <div class="userProfilePage_section userProfilePage_section--form mb-5">
            <form action="{{ route('user.update', ['locale' => app()->getLocale(), 'user' => $user->username]) }}"
                method="POST" class="formGeneral userProfilePage_editForm mt-3">
                @csrf
                @method('PATCH')

                <h2 class="userProfilePage_editFormTitle">{{ __('pages.user_profile.form.title') }}</h2>

                {{-- Name Field --}}
                <div class="mb-3">
                    <label class="form-label" for="profile-name">{{ __('pages.user_profile.form.name') }}</label>
                    <input id="profile-name" type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="form-control @error('name') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.form.name_placeholder') }}">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username Field --}}
                <div class="mb-3">
                    <label class="form-label" for="profile-username">{{ __('pages.user_profile.form.username') }}</label>
                    <input id="profile-username" type="text" name="username" value="{{ old('username', $user->username) }}"
                        class="form-control @error('username') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.form.username_placeholder') }}">
                    @error('username')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Field --}}
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

        <div class="userProfilePage_section userProfilePage_section--form mb-5">
            <form action="{{ route('user.password.update', ['locale' => app()->getLocale(), 'user' => $user->username]) }}"
                method="POST" class="formGeneral userProfilePage_editForm mt-3">
                @csrf
                @method('PATCH')

                <h2 class="userProfilePage_editFormTitle">{{ __('pages.user_profile.password_form.title') }}</h2>

                <div class="mb-3">
                    <label class="form-label" for="profile-current-password">{{ __('pages.user_profile.password_form.current_password') }}</label>
                    <input id="profile-current-password" type="password" name="current_password"
                        class="form-control @error('current_password') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.password_form.current_password_placeholder') }}"
                        autocomplete="current-password">
                    @error('current_password')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="profile-new-password">{{ __('pages.user_profile.password_form.password') }}</label>
                    <input id="profile-new-password" type="password" name="password"
                        class="form-control @error('password') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.password_form.password_placeholder') }}"
                        autocomplete="new-password">
                    @error('password')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="profile-new-password-confirmation">{{ __('pages.user_profile.password_form.password_confirmation') }}</label>
                    <input id="profile-new-password-confirmation" type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') ring-red @enderror"
                        placeholder="{{ __('pages.user_profile.password_form.password_confirmation_placeholder') }}"
                        autocomplete="new-password">
                    @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btnPrimary">{{ __('pages.user_profile.password_form.submit') }}</button>
            </form>
        </div>
        @endauth
    </div>
</section>
@endsection