@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.products.title') }}</h2>
<hr class="border border-gray border-2">
<div class="dashboard_Product container-fluid m-auto p-3"
    data-fetch-url="{{ route('dashboard-products.search') }}"
    data-update-url-template="{{ route('dashboard-products.update', ['dashboard_product' => '__PRODUCT_ID__']) }}">
    <div class="col-12 col-md-6 m-2">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input type="search" name="productSearch" class="dashboard_ProductSearch form-control"
                placeholder="{{ __('dashboard.products.search_placeholder') }}">
        </div>
    </div>
            <div class="dashboard_ProductInfo container-fluid m-auto">
        <table class="table_dashboardGeneral table_dashboardGeneral--products">
            <thead>
                <td>ID</td>
                <td>{{ __('dashboard.products.name') }}</td>
                <td>{{ __('dashboard.products.slug') }}</td>
                <td>{{ __('dashboard.products.price') }}</td>
                <td>{{ __('dashboard.products.category') }}</td>
                <td>{{ __('dashboard.products.status') }}</td>
                <td>{{ __('dashboard.products.position') }}</td>
                <td></td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--products"
                data-change-label="{{ __('dashboard.products.change') }}"
                data-no-data-label="{{ __('dashboard.products.no_data') }}"
                data-update-error="{{ __('dashboard.products.update_error') }}">
                {{-- Script --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
