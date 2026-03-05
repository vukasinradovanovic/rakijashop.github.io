@props([
    'categories'         => collect(),
    'selectedCategory'   => '',
    'selectedSort'       => 'newest',
    'searchQuery'        => '',
])

@php
    $activeCount = 0;
    if ($searchQuery)                                    $activeCount++;
    if ($selectedCategory)                               $activeCount++;
    if ($selectedSort && $selectedSort !== 'newest')     $activeCount++;
@endphp

<div class="filterForm {{ $activeCount > 0 ? 'filterForm--hasFilters' : '' }}">

    {{-- Mobile toggle --}}
    <button type="button" class="filterForm_toggleBtn" aria-expanded="false" aria-controls="filterFormBody">
        <i class="fa-solid fa-sliders filterForm_toggleBtnIcon"></i>
        <span class="filterForm_toggleBtnLabel">{{ __('product.filter.toggle') }}</span>
        @if ($activeCount > 0)
            <span class="filterForm_toggleBtnCount">{{ $activeCount }}</span>
        @endif
        <i class="fa-solid fa-chevron-down filterForm_toggleBtnChevron"></i>
    </button>

    {{-- Filter body (visible always on desktop, toggled on mobile) --}}
    <form
        id="filterFormBody"
        class="filterForm_body"
        method="GET"
        action="{{ route('product.index') }}"
    >
        <div class="filterForm_groups">

            {{-- Search --}}
            <div class="filterForm_group filterForm_group--search">
                <label for="filterSearch" class="filterForm_groupLabel">
                    {{ __('product.filter.search') }}
                </label>
                <div class="filterForm_groupInputWrapper">
                    <i class="fa-solid fa-magnifying-glass filterForm_groupInputIcon"></i>
                    <input
                        id="filterSearch"
                        type="text"
                        name="search"
                        class="form-control filterForm_groupInput"
                        placeholder="{{ __('product.filter.searchPlaceholder') }}"
                        value="{{ $searchQuery }}"
                        autocomplete="off"
                    >
                </div>
            </div>

            {{-- Category --}}
            @if ($categories->count())
                <div class="filterForm_group filterForm_group--category">
                    <label for="filterCategory" class="filterForm_groupLabel">
                        {{ __('product.filter.category') }}
                    </label>
                    <select
                        id="filterCategory"
                        name="category"
                        class="form-select filterForm_groupInput"
                    >
                        <option value="">{{ __('product.filter.categoryAll') }}</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ (string) $selectedCategory === (string) $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- Sort --}}
            <div class="filterForm_group filterForm_group--sort">
                <label for="filterSort" class="filterForm_groupLabel">
                    {{ __('product.filter.sort') }}
                </label>
                <select
                    id="filterSort"
                    name="sort"
                    class="form-select filterForm_groupInput"
                >
                    <option value="newest"     {{ $selectedSort === 'newest'     ? 'selected' : '' }}>{{ __('product.filter.sortNewest') }}</option>
                    <option value="price_asc"  {{ $selectedSort === 'price_asc'  ? 'selected' : '' }}>{{ __('product.filter.sortPriceAsc') }}</option>
                    <option value="price_desc" {{ $selectedSort === 'price_desc' ? 'selected' : '' }}>{{ __('product.filter.sortPriceDesc') }}</option>
                </select>
            </div>

        </div>

        {{-- Actions --}}
        <div class="filterForm_actions">
            <button type="submit" class="btn btnPrimary filterForm_submitBtn">
                <i class="fa-solid fa-check me-1"></i>
                {{ __('product.filter.apply') }}
            </button>
            <a
                href="{{ route('product.index') }}"
                class="btn filterForm_resetBtn {{ $activeCount > 0 ? '' : 'filterForm_resetBtn--hidden' }}"
            >
                <i class="fa-solid fa-xmark me-1"></i>
                {{ __('product.filter.reset') }}
            </a>
        </div>

    </form>
</div>
