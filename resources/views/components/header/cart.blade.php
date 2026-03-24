@php
    $cartQuantity = \App\Http\Controllers\Product\CartController::getCartQuantity();
@endphp

<a href="{{ route('cart.index') }}"
    class="siteNav_cart {{ request()->routeIs('cart.*') ? 'siteNav_cart--active' : '' }}"
    aria-label="{{ __('cart.nav.aria_label', ['count' => $cartQuantity]) }}">
    <i class="fa-solid fa-cart-shopping"></i>
    <span class="siteNav_cartLabel">{{ __('cart.nav.label') }}</span>
    <span class="siteNav_cartBadge">{{ $cartQuantity }}</span>
</a>
