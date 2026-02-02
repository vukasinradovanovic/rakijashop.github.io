<nav class="topNavbar p-1">
  <div class="container d-flex justify-content-center justify-content-sm-between align-items-center">

    <div class="social-icons d-none d-sm-flex gap-4">
      <a href="https://www.instagram.com" target="_blank" class="text-white">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://www.tiktok.com" target="_blank" class="text-white">
        <i class="fab fa-tiktok"></i>
      </a>
      <a href="https://www.facebook.com" target="_blank" class="text-white">
        <i class="fab fa-facebook-f"></i>
      </a>
    </div>
    {{-- <ul class="nav justify-content-end p-0 mb-0">
      @foreach (__('nav.helpNav') as $item)
      <li class="nav-item {{ request()->url() == $item['slug'] ? 'active' : '' }}">
        <a class="nav-link btnUnderline" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
      </li>
      @endforeach
      @foreach (__('nav.languages') as $lang)
      <li>
        <a class="nav-link btnUnderline" href="{{ $lang['slug'] }}">{{ $lang['name'] }}</a>
        @if ($lang['separator'])
          <li class="text-white">|</li>
        @endif
      </li>
      @endforeach
    </ul> --}}
  </div>
</nav>

{{-- Main navigation --}}
<nav class="navbar navbar-expand-lg sticky-top navbarMain">
  <div class="container">

    {{-- Logo --}}
    <a class="navbarMain_logo me-2" href="{{route('index')}}">
      <span>Rakija Shop</span>
    </a>

    {{-- toggler button --}}
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- sidebar --}}
    <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
      aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header border-bottom">

        {{-- logo --}}
        <a class="navbarMain_logo me-2" href="{{route('index')}}">
          <img src="{{ asset('img/logo.svg') }}" alt="Logo">
        </a>

        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column-reverse flex-lg-row">

        {{-- nav list --}}
        <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 mb-5 mb-lg-0">
          @foreach (__('nav.nav') as $item)
          <li class="nav-item mx-2 mb-4 mb-lg-0 {{ request()->url() == $item['slug'] ? 'active' : '' }}">

            <a class="nav-link d-flex align-items-center" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
          </li>
          @endforeach
        </ul>

        @guest
        <div id="navbar_guest_buttons"
          class="d-flex justify-content-center align-items-center flex-column flex-lg-row mb-3 mb-lg-0">
          <a href="{{ route('login') }}" class="btn btnUnderline">
            <i class="fa fa-sign-in"></i>&nbsp;{{ __('auth.login') }}
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a>
          <a href="{{ route('register') }}"><button class="btn btnPrimary"><i class="fa fa-user-plus"></i>&nbsp;{{
              __('auth.register') }}</button></a>
        </div>
        @endguest

        @auth
        <div class="d-flex justify-content-center align-items-center flex-column-reverse flex-lg-row mb-3 mb-lg-0">

          {{-- Profile dropdown nav menu --}}
          <div class="profile-container mt-3 mt-lg-0">
            {{-- User Images --}}
            <div class="profile-icon" style="background-image: url('{{ Auth::user()->profile_image }}');">
            </div>
            <div class="dropdown-menu">
              <span class="dropdown-menuText">{{ Auth::user()->name }}</span>
              @foreach (__('nav.dropdown-user') as $item)
              <a class="dropdown-menuLink" href=" {{ $item['slug'] }} ">{!! $item['name'] !!}</a>
              @endforeach
            </div>
          </div>

          {{-- Logout button --}}
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btnPrimary"><i class="fa fa-sign-out"></i>&nbsp;{{
              __('auth.logout') }}</button>
          </form>
        </div>
        @endauth

      </div>
    </div>
  </div>
</nav>