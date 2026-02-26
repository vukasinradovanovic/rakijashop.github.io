@props(['companyInfo' => null])

<footer class="siteFooter">
    <div class="container">
        <div class="row g-4 siteFooter_content">
            <div class="col-md-5">
                {{-- Logo section --}}
                <x-sections.logo whiteText="true" />

                <p class="siteFooter_brandText">{{ __('footer.aboutTitle') }}</p>
                <p class="siteFooter_lede">
                    {{ __('footer.ledeText') }}
                </p>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <p class="siteFooter_heading">{{ __('footer.linkTitle') }}</p>
                <ul class="siteFooter_list">
                    @foreach (__('nav.nav') as $item)
                    <li class="siteFooter_item">
                        <a class="siteFooter_link" href="{{ $item['slug'] }}">{{ $item['name'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-3 col-lg-2">
                <p class="siteFooter_heading">{{ __('footer.contactTitle') }}</p>
                <ul class="siteFooter_list">
                    <li class="siteFooter_item"><i class="fa fa-home me-2"></i>{{ __('footer.city') }}</li>
                    @if($companyInfo)
                    <li class="siteFooter_item"><i class="fa fa-envelope me-2"></i>{{ $companyInfo->email_1 }}</li>
                    <li class="siteFooter_item"><i class="fa fa-phone me-2"></i>{{ $companyInfo->phone_1 }}</li>
                    <li class="siteFooter_item"><i class="fa fa-phone me-2"></i>{{ $companyInfo->phone_2 }}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="siteFooter_bottom text-center">
            <span>&copy; {{ date('Y') }} {{ $companyInfo->name ?? __('footer.defaultCompanyName') }} {{ __('footer.responsible') }}</span>
        </div>
    </div>
</footer>