@extends('layout.layout')

@section('main')
<section class="sectionBlock sectionBlock--light">
    <div class="container userProfilePage">
        <h2 class="userProfilePage_editFormTitle">{{ __('pages.user_profile.form.title') }}</h2>

        @auth
        @if ((int) auth()->id() === (int) $user->id)
        <div class="userProfilePage_section userProfilePage_section--form mb-5">
            <form action="{{ route('user.update', ['locale' => app()->getLocale(), 'user' => $user->username]) }}"
                method="POST" class="formGeneral userProfilePage_editForm mt-3">
                @csrf
                @method('PATCH')

                <h2 class="userProfilePage_editFormTitle">{{ __('pages.user_profile.form.title') }}</h2>

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
    </div>
</section>
@endsection