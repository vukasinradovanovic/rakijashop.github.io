@props(['companyInfo' => null])

<footer class="siteFooter">
    <div class="container">
        <div class="row g-4 siteFooter__content">
            <div class="col-md-5">
                <div class="siteFooter__brand">
                    <div class="siteFooter__logoMark">R</div>
                    <div>
                        <p class="siteFooter__brandTitle">Rakija &amp; Co.</p>
                        <p class="siteFooter__brandText">{{ __('footer.aboutTitle') }}</p>
                    </div>
                </div>
                <p class="siteFooter__lede">
                    Curating the finest Balkan spirits. Authentic, premium, and delivered to your doorstep.
                </p>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <p class="siteFooter__heading">{{ __('footer.linkTitle') }}</p>
                <ul class="siteFooter__list">
                    @foreach (__('nav.nav') as $item)
                        <li class="siteFooter__item">
                            <a class="siteFooter__link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <p class="siteFooter__heading">{{ __('footer.contactTitle') }}</p>
                <ul class="siteFooter__list">
                    <li class="siteFooter__item"><i class="fa fa-home me-2"></i>Beograd, Srbija</li>
                    @if($companyInfo)
                        <li class="siteFooter__item"><i class="fa fa-envelope me-2"></i>{{ $companyInfo->email_1 }}</li>
                        <li class="siteFooter__item"><i class="fa fa-phone me-2"></i>{{ $companyInfo->phone_1 }}</li>
                        <li class="siteFooter__item"><i class="fa fa-phone me-2"></i>{{ $companyInfo->phone_2 }}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="siteFooter__bottom">
            <span>&copy; {{ date('Y') }} {{ $companyInfo->name ?? 'Rakija & Co.' }}</span>
            <span class="siteFooter__note">Please drink responsibly.</span>
        </div>
    </div>
</footer>
