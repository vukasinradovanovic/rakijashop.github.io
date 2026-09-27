@props(['categories' => []])

<form action="{{ route('product.index') }}" method="GET" class="filterForm">
    <div class="row g-3">
        {{-- Filter by category --}}
        <div class="col-12">
            <label for="filterCategory" class="form-label">{{ __('product.filter.category') }}</label>
            <select name="category" id="filterCategory" class="form-select filterForm_select">
                <option value="">{{ __('product.filter.all_categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter by price range --}}
        <div class="col-12">
            <div class="filterForm_rangeHeader">
                <label for="filterPriceMin" class="form-label">{{ __('product.filter.price') }}</label>
                <output class="filterForm_rangeValue" data-range-output="price">{{ request('price_min', 0) }} - {{ request('price_max', 5000) }} RSD</output>
            </div>
            <div class="filterForm_rangeGroup">
                <input type="range" name="price_min" id="filterPriceMin" value="{{ request('price_min', 0) }}" min="0" max="5000" step="50" class="filterForm_range" data-range="price-min">
                <input type="range" name="price_max" id="filterPriceMax" value="{{ request('price_max', 5000) }}" min="0" max="5000" step="50" class="filterForm_range" data-range="price-max">
            </div>
        </div>

        {{-- Filter by bottle volume range --}}
        <div class="col-12">
            <div class="filterForm_rangeHeader">
                <label for="filterVolumeMin" class="form-label">{{ __('product.filter.volume') }}</label>
                <output class="filterForm_rangeValue" data-range-output="volume">{{ request('volume_min', 0) }} - {{ request('volume_max', 2000) }} ml</output>
            </div>
            <div class="filterForm_rangeGroup">
                <input type="range" name="volume_min" id="filterVolumeMin" value="{{ request('volume_min', 0) }}" min="0" max="2000" step="50" class="filterForm_range" data-range="volume-min">
                <input type="range" name="volume_max" id="filterVolumeMax" value="{{ request('volume_max', 2000) }}" min="0" max="2000" step="50" class="filterForm_range" data-range="volume-max">
            </div>
        </div>

        {{-- Filter by alcohol percentage range --}}
        <div class="col-12">
            <div class="filterForm_rangeHeader">
                <label for="filterAlcoholMin" class="form-label">{{ __('product.filter.alcohol') }}</label>
                <output class="filterForm_rangeValue" data-range-output="alcohol">{{ request('alcohol_min', 0) }} - {{ request('alcohol_max', 100) }}%</output>
            </div>
            <div class="filterForm_rangeGroup">
                <input type="range" name="alcohol_min" id="filterAlcoholMin" value="{{ request('alcohol_min', 0) }}" min="0" max="100" step="1" class="filterForm_range" data-range="alcohol-min">
                <input type="range" name="alcohol_max" id="filterAlcoholMax" value="{{ request('alcohol_max', 100) }}" min="0" max="100" step="1" class="filterForm_range" data-range="alcohol-max">
            </div>
        </div>

        {{-- Submit and reset buttons --}}
        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn filterForm_btn filterForm_btn--submit w-100">
                <i class="fa fa-search" aria-hidden="true"></i> {{ __('product.filter.apply') }}
            </button>
            <a href="{{ route('product.index') }}" class="btn filterForm_btn filterForm_btn--reset w-100" aria-label="{{ __('product.filter.reset') }}">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</form>
