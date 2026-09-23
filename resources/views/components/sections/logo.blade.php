{{-- If there is need for text to be different color atribute 'white-text' is set to true --}}
@props(['whiteText' => false])
<a class="brandLogo" href="{{ route('index', ['locale' => app()->getLocale() ?: config('app.fallback_locale', 'en')]) }}">
    <span class="brandLogo_mark">R</span>
    <span class="brandLogo_text{{ $whiteText ? 'Secondary' : 'Primary' }}">Rakija &amp; Co.</span>
</a>