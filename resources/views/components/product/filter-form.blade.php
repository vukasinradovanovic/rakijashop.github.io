@props(['categories' => []])

<form action="{{ route('product.index') }}" method="GET" class="filterForm">
    <div class="row g-3">
        {{-- Search by name --}}
        <div class="col-12">
            <label for="filterSearch" class="form-label">{{ __('product.filter.search') }}</label>
            <input
                type="text"
                name="search"
                id="filterSearch"
                value="{{ request('search') }}"
                class="form-control filterForm_input"
                placeholder="{{ __('product.filter.search_placeholder') }}"
            >
        </div>

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

        {{-- Filter by minimum price --}}
        <div class="col-12">
            <label for="filterPriceMin" class="form-label">{{ __('product.filter.price_min') }}</label>
            <input
                type="number"
                name="price_min"
                id="filterPriceMin"
                value="{{ request('price_min') }}"
                min="0"
                step="0.01"
                class="form-control filterForm_input"
                placeholder="0"
            >
        </div>

        {{-- Filter by maximum price --}}
        <div class="col-12">
            <label for="filterPriceMax" class="form-label">{{ __('product.filter.price_max') }}</label>
            <input
                type="number"
                name="price_max"
                id="filterPriceMax"
                value="{{ request('price_max') }}"
                min="0"
                step="0.01"
                class="form-control filterForm_input"
                placeholder="{{ __('product.filter.price_max_placeholder') }}"
            >
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
