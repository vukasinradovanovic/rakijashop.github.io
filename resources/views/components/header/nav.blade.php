<div class="siteNav__top">
  <div class="container d-flex justify-content-end align-items-center gap-3">
    <a class="siteNav__topLink" href="https://www.instagram.com" target="_blank" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
    <a class="siteNav__topLink" href="https://www.tiktok.com" target="_blank" aria-label="TikTok">
      <i class="fab fa-tiktok"></i>
    </a>
    <a class="siteNav__topLink" href="https://www.facebook.com" target="_blank" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>
  </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top siteNav">
  <div class="container siteNav__container">
    <a class="siteNav__brand" href="{{ route('index') }}">
      <span class="siteNav__brandMark">R</span>
      <span class="siteNav__brandText">Rakija &amp; Co.</span>
    </a>

    <div class="d-flex align-items-center gap-2 order-lg-3">
      <a href="{{ route('product.create') }}" class="btn btnPrimary siteNav__cta d-none d-md-inline-flex">Dodaj proizvod</a>
      <button class="navbar-toggler siteNav__toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavMenu"
        aria-controls="siteNavMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse siteNav__menu" id="siteNavMenu">
      <ul class="navbar-nav siteNav__links ms-lg-auto mb-3 mb-lg-0">
        @foreach (__('nav.nav') as $item)
        <li class="nav-item siteNav__item {{ request()->url() == $item['slug'] ? 'is-active' : '' }}">
          <a class="nav-link siteNav__link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
        </li>
        @endforeach
      </ul>

      <div class="siteNav__actions d-flex align-items-center gap-3">
        @guest
        <a href="{{ route('login') }}" class="siteNav__ghost">{{ __('auth.login') }}</a>
        <a href="{{ route('register') }}" class="btn btnPrimary siteNav__cta">{{ __('auth.register') }}</a>
        @endguest

        @auth
        <a href="{{ route('product.create') }}" class="btn btnPrimary siteNav__cta d-md-none">Dodaj proizvod</a>
        <div class="dropdown siteNav__profile">
          <button class="btn dropdown-toggle siteNav__profileBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="siteNav__profileAvatar" style="background-image: url('{{ Auth::user()->profile_image }}');"></span>
            <span class="siteNav__profileName">{{ Auth::user()->name }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end siteNav__profileMenu">
            <li class="siteNav__profileGreeting">{{ Auth::user()->name }}</li>
            @foreach (__('nav.dropdown-user') as $item)
              <li><a class="dropdown-item" href="{{ $item['slug'] }}">{!! $item['name'] !!}</a></li>
            @endforeach
            @if (Auth::user()->hasRole('admin'))
              <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">{!! __('dashboard.dashboard-page') !!}</a></li>
            @endif
            <li><hr class="dropdown-divider"></li>
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