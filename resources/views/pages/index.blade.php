@extends('layout.layout')

@section('main')
    <section class="siteHero">
        <div class="siteHero__overlay"></div>
        <div class="container siteHero__content">
            <span class="siteHero__badge">Premium Balkan Spirits</span>
            <h1 class="siteHero__title">Duša voća, <span class="siteHero__title--accent">uhvaćena u boci</span>.</h1>
            <p class="siteHero__text">
                Otkrij pažljivo kuriranu selekciju zanatske rakije iz najboljih destilerija Balkana.
            </p>
            <div class="siteHero__actions">
                <a href="{{ route('product.index') }}" class="btn btnPrimary">Istaknuta kolekcija</a>
                <a href="{{ route('contact') }}" class="siteHero__ghost">Kontaktiraj nas</a>
            </div>
        </div>
    </section>

    <section class="sectionBlock sectionBlock--light">
        <div class="container">
            <div class="sectionBlock__header">
                <div>
                    <p class="sectionBlock__eyebrow">Ručno birano</p>
                    <h2 class="sectionBlock__title">Istaknuta selekcija</h2>
                    <p class="sectionBlock__subtitle">Favoriti za istinske poznavaoce.</p>
                </div>
                <a href="{{ route('product.index') }}" class="sectionBlock__link">Vidi sve <i class="fa fa-arrow-right"></i></a>
            </div>

            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <x-product.product-card :product="$product" class="productCard--accent" />
                    </div>
                @empty
                    <p class="text-muted mb-0">Još uvek nema dostupnih proizvoda.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="sectionBlock sectionBlock--muted">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="storyCard">
                        <p class="storyCard__eyebrow">Tradicionalno. Autentično.</p>
                        <h3 class="storyCard__title">Destilerije koje čuvaju zanat.</h3>
                        <p class="storyCard__text">
                            Saradjujemo isključivo sa destilerijama koje poštuju tradiciju i savremene standarde kvaliteta.
                        </p>
                        <ul class="storyCard__list">
                            <li class="storyCard__listItem"><i class="fa fa-check"></i> 100% prirodna fermentacija voća</li>
                            <li class="storyCard__listItem"><i class="fa fa-check"></i> Odležavanje u hrastovim buradima</li>
                            <li class="storyCard__listItem"><i class="fa fa-check"></i> Dokazano poreklo i kvalitet</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="storyCard__media">
                        <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&w=1200&q=80" alt="Destilerija" class="storyCard__image">
                        <div class="storyCard__badge">Rakija &amp; Co.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection