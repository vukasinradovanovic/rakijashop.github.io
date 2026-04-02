@extends('layout.layout')

@section('main')
<section class="pageSection">
    <div class="container">
        <h1 class="pageSection_title">{{ __('pages.contact.title') }}</h1>
        <p class="pageSection_subtitle">{{ __('pages.contact.subtitle') }}</p>

        <form action="{{ route('contact.store')}}" method="POST"
            class="formGeneral mt-4">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="contact-name">{{ __('pages.contact.form.name') }}</label>
                <input id="contact-name" type="text" name="name"
                    value="{{ old('name', $userInfo['name'] ?? '') }}"
                    placeholder="{{ __('pages.contact.form.name_placeholder') }}"
                    class="form-control @error('name') ring-red @enderror">
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="contact-email">{{ __('pages.contact.form.email') }}</label>
                <input id="contact-email" type="email" name="email"
                    value="{{ old('email', $userInfo['email'] ?? '') }}"
                    placeholder="{{ __('pages.contact.form.email_placeholder') }}"
                    class="form-control @error('email') ring-red @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="contact-type">{{ __('pages.contact.form.type') }}</label>
                <select id="contact-type" name="type_id" class="form-select @error('type_id') ring-red @enderror">
                    <option value="">{{ __('pages.contact.form.type_placeholder') }}</option>
                    @foreach ($questionTypes as $questionType)
                    <option value="{{ $questionType->id }}" @selected((string) old('type_id')===(string) $questionType->
                        id)>
                        {{ $questionType->name }}
                    </option>
                    @endforeach
                </select>
                @error('type_id')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="contact-description">{{ __('pages.contact.form.description') }}</label>
                <textarea id="contact-description" name="description" rows="5"
                    placeholder="{{ __('pages.contact.form.description_placeholder') }}"
                    class="form-control @error('description') ring-red @enderror">{{ old('description') }}</textarea>
                @error('description')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btnPrimary">{{ __('pages.contact.form.submit') }}</button>
        </form>
    </div>
</section>
@endsection