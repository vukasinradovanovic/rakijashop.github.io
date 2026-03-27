@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.category_products.title') }}</h2>
<hr class="border border-gray border-2">

<div class="dashboardCategoryProducts container-fluid m-auto p-3"
    data-search-url="{{ route('dashboard-category-products.search') }}"
    data-store-url="{{ route('dashboard-category-products.store') }}"
    data-update-url-template="{{ route('dashboard-category-products.update', ['dashboard_category_product' => '__CATEGORY_ID__']) }}"
    data-delete-url-template="{{ route('dashboard-category-products.destroy', ['dashboard_category_product' => '__CATEGORY_ID__']) }}"
    data-no-data-label="{{ __('dashboard.category_products.no_data') }}"
    data-save-label="{{ __('dashboard.category_products.save') }}"
    data-delete-label="{{ __('dashboard.category_products.delete') }}"
    data-active-label="{{ __('dashboard.category_products.active') }}"
    data-inactive-label="{{ __('dashboard.category_products.inactive') }}"
    data-confirm-delete="{{ __('dashboard.category_products.delete') }}?"
    data-save-error="{{ __('dashboard.category_products.save_error') }}"
    data-delete-error="{{ __('dashboard.category_products.delete_error') }}"
    data-create-error="{{ __('dashboard.category_products.create_error') }}">

    <div class="dashboardCategoryProducts_createBlock mb-4">
        <h5 class="mb-2">{{ __('dashboard.category_products.create_title') }}</h5>
        <div class="dashboardCategoryProducts_createForm row g-2">
            <div class="col-12 col-md-5">
                <input
                    type="text"
                    class="dashboardCategoryProducts_createInput--name form-control"
                    placeholder="{{ __('dashboard.category_products.name') }}"
                    maxlength="120">
            </div>
            <div class="col-12 col-md-4">
                <input
                    type="text"
                    class="dashboardCategoryProducts_createInput--slug form-control"
                    placeholder="{{ __('dashboard.category_products.slug') }}"
                    maxlength="140">
            </div>
            <div class="col-8 col-md-2">
                <select class="dashboardCategoryProducts_createInput--status form-select">
                    <option value="1">{{ __('dashboard.category_products.active') }}</option>
                    <option value="0">{{ __('dashboard.category_products.inactive') }}</option>
                </select>
            </div>
            <div class="col-4 col-md-1 d-grid">
                <button type="button" class="btn btn-secondary dashboardCategoryProducts_createButton">
                    {{ __('dashboard.category_products.create') }}
                </button>
            </div>
        </div>
    </div>

    <div class="dashboardCategoryProducts_searchBlock mb-4">
        <label for="dashboardCategoryProductsSearch" class="form-label">{{ __('dashboard.category_products.title') }}</label>
        <div class="input-group dashboardCategoryProducts_controlsSearch">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input
                id="dashboardCategoryProductsSearch"
                type="search"
                class="dashboardCategoryProducts_controlsSearchInput form-control"
                placeholder="{{ __('dashboard.category_products.search_placeholder') }}">
        </div>
    </div>

    <div class="dashboardCategoryProducts_tableWrap container-fluid m-auto px-0">
        <table class="table_dashboardGeneral table_dashboardGeneral--categoryProducts dashboardCategoryProducts_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('dashboard.category_products.name') }}</th>
                    <th>{{ __('dashboard.category_products.slug') }}</th>
                    <th>{{ __('dashboard.category_products.status') }}</th>
                    <th>{{ __('dashboard.category_products.products_count') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table_dashboardGeneralTbody dashboardCategoryProducts_tableBody">
                {{-- Script --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
