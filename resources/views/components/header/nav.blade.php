{{-- Nav top section --}}
<div class="siteNav_top">
  <div class="container d-flex justify-content-end align-items-center gap-3">
    {{-- Socials section --}}
    <a class="siteNav_topLink" href="https://www.instagram.com" target="_blank" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
    <a class="siteNav_topLink" href="https://www.tiktok.com" target="_blank" aria-label="TikTok">
      <i class="fab fa-tiktok"></i>
    </a>
    <a class="siteNav_topLink" href="https://www.facebook.com" target="_blank" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>

    {{-- Localization section --}}
    @foreach (($localization['language_switches'] ?? []) as $languageSwitch)
    <a class="siteNav_topLink {{ $languageSwitch['is_current'] ? 'fw-bold text-decoration-underline' : '' }}"
      href="{{ $languageSwitch['url'] }}">{{ $languageSwitch['label'] }}</a>
    @endforeach
  </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top siteNav">
  <div class="container siteNav_container">
    {{-- Logo section --}}
    <x-sections.logo />

    <div class="d-flex align-items-center gap-2 order-lg-3">
      <button class="navbar-toggler siteNav_toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#siteNavMenu" aria-controls="siteNavMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse siteNav_menu" id="siteNavMenu">
      <ul class="navbar-nav siteNav_links ms-lg-auto mb-3 mb-lg-0">
        @foreach (__('nav.nav') as $item)
        <li class="nav-item siteNav_item {{ request()->url() == $item['slug'] ? 'is-active' : '' }}">
          <a class="nav-link siteNav_link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
        </li>
        @endforeach
      </ul>

      <div class="siteNav_actions d-flex align-items-center gap-3">
        <x-header.cart :cart-quantity="$cartQuantity" />

        @guest
        <a href="{{ route('login') }}" class="siteNav_ghost">{{ __('auth.login') }}</a>
        <a href="{{ route('register') }}" class="btn btnPrimary ">{{ __('auth.register') }}</a>
        @endguest

        @auth
        <a href="{{ route('product.create') }}" class="btn btnPrimary siteNav_cta d-md-none">{{
          __('product.form.create_title') }}</a>
        <div class="dropdown siteNav_profile">
          <button class="btn dropdown-toggle siteNav_profileBtn" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="siteNav_profileAvatar"
              style="background-image: url('{{ Auth::user()->profile_image }}');"></span>
            <span class="siteNav_profileName">{{ Auth::user()->name }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end siteNav_profileMenu">
            <li class="siteNav_profileGreeting">{{ Auth::user()->name }}</li>
            @foreach (__('nav.dropdown-user') as $item)
            @php
            $itemHref = $item['slug'] ?? '#';

            if (($item['route_name'] ?? null) === 'user.show') {
            $itemHref = route('user.show', [
            'locale' => app()->getLocale(),
            'user' => filled(Auth::user()->username ?? null)
            ? Auth::user()->username
            : (string) Auth::id(),
            ]);
            } elseif (!empty($item['route_name'])) {
            $itemHref = route($item['route_name'], ['locale' => app()->getLocale()]);
            }
            @endphp
            <li><a class="dropdown-item" href="{{ $itemHref }}">{!! $item['name'] !!}</a></li>
            @endforeach
            @if (Auth::user()->hasRole('admin'))
            <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard-page')
                !!}</a></li>
            @endif
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger" type="submit">{{ __('auth.logout') }}</button>
              </form>
            </li>
          </ul>
        </div>
        @endauth
      </div>
    </div>
  </div>
</nav>