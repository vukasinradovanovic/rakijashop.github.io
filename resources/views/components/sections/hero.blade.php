<section class="siteHero">
    <div class="siteHero_overlay"></div>
    <div class="container siteHero_content text-center">
        <span class="siteHero_badge">{{ __('pages.hero.badge') }}</span>
        <h1 class="siteHero_title">{{ __('pages.hero.title') }}</h1>
        <p class="siteHero_text">
            {{ __('pages.hero.text') }}
        </p>
        <div class="siteHero_actions">
            <a href="{{ route('product.index') }}" class="btn btnPrimary">{{ __('pages.hero.featured_collection') }}</a>
            <a href="{{ route('contact') }}" class="btn btnSecondary">{{ __('pages.hero.contact_us') }}</a>
        </div>
    </div>
</section>