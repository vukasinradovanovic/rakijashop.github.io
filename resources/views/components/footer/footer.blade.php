@props(['companyInfo'])

<div class="container-fluid p-0">
    <footer class="text-center text-lg-start bg-primary-color text-white pt-4">
        <section class="">
            <div class="container text-center text-md-start mt-0">

                <div class="row mt-3">

                    {{-- <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-3">{{ __('footer.aboutTitle') }}</h6>

                          @foreach (__('nav.helpNav') as $item)
                              <li class="pb-2 nav-item {{ request()->url() == $item['slug'] ? 'active' : '' }}">
                                <a class="footer-link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
                                </li>
                          @endforeach
                        
                        <div class="logoFooter  w-75 w-md-75 w-lg-50 mt-3">
                            <a class="navbarMain_logo me-2" href="{{ route('index') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                            </a>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-3">{{ __('footer.links') }}</h6>
                        @foreach (__('nav.animalLinks') as $item)
                            <li class="footer-item mx-2 mb-4 mb-lg-2">
                                <a class="footer-link" href=" {{ $item['slug'] }}" target="_blank">{{ $item['name'] }}</a>
                            </li>
                        @endforeach


                    </div> --}}

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <h6 class="text-uppercase fw-bold mb-3">{{ __('footer.linkTitle') }}</h6>
                        @foreach (__('nav.nav') as $item)
                            <li class="footer-item mx-2 mb-4 mb-lg-2">
                                <a class="footer-link" href=" {{ $item['slug'] }} ">{{ $item['name'] }}</a>
                            </li>
                        @endforeach


                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                        <h6 class="text-uppercase fw-bold mb-3">{{ __('footer.contactTitle') }}</h6>
                        <p><i class="fa fa-home mr-3"></i> Beograd, Srbija</p>
                        <p><i class="fa fa-envelope mr-3"></i> {{ $companyInfo->email_1 }}</p>
                        <p><i class="fa fa-phone mr-3"></i> {{ $companyInfo->phone_1 }}</p>
                        <p><i class="fa fa-phone mr-3"></i> {{ $companyInfo->phone_2 }}</p>
                    </div>

                </div>

            </div>
        </section>
        <div class="text-center p-1 copyright">
            {{-- <div class="d-flex justify-content-center">
                <div class="footer-item mx-2 mb-4 mb-lg-2">
                    <a class="footer-link" href="{{ route('privacyPolicy') }}">{{ __('footer.Privacy') }}</a>
                </div>
                <span>|</span>
                <div class="footer-item mx-2 mb-4 mb-lg-2">
                    <a class="footer-link" href="{{ route('termsOfUse') }}">{{ __('footer.termsOfUse') }}</a>
                </div>
            </div> --}}
            <div>
                &copy; {{ date('Y') }} Copyright:
                <a href="{{ url('/') }}">{{ $companyInfo->name }}</a>
            </div>
        </div>
    </footer>
</div>
