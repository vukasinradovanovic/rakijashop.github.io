@props(['action' => 'product.index'])

<div class="productPage_search col-12 mb-5">
    <form method="GET" action="{{ route($action) }}" class="productPage_searchForm">
        <label for="productPageSearch" class="visually-hidden">{{ __('product.filter.search') }}</label>
        <div class="input-group productPage_searchGroup">
            <input id="productPageSearch" type="text" name="search" value="{{ request('search') }}"
                class="form-control productPage_searchInput"
                placeholder="{{ __('product.filter.search_placeholder') }}">

            <button type="submit" class="btn btnPrimary productPage_searchButton">
                {{ __('product.filter.search') }}
            </button>
        </div>
    </form>
</div>