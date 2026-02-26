@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.search.title') }}</h2>
<hr class="border border-gray border-2">
<div class="dashboard_searchData container-fluid m-auto p-3">
    {{-- Sort and filter section --}}
    <div class="dashboard_searchDataFilter">
        <div class="row m-2">
            <div class="col-2">
                <label for="searchDataSort">{{ __('dashboard.search.sort') }}</label>
                <select name="searchDataSort" id="searchDataSort" class="dashboard_searchDataFilterSort">
                    <option value="0" {{ request('sort')==0 ? 'selected' : '' }}>{{ __('dashboard.search.most_searches') }}</option>
                    <option value="1" {{ request('sort')==1 ? 'selected' : '' }}>{{ __('dashboard.search.least_searches') }}</option>
                </select>
            </div>
        </div>
    </div>
    <hr class="border border-gray border-2">
    {{-- Section for search data from text types on site --}}
    <div class="dashboard_searchDataInfo container-fluid m-auto">
        <h4 class="text-center">{{ __('dashboard.search.input_title') }}</h4>
        <table class="table_dashboardGeneral table_dashboardGeneral--searchData">
            <thead>
                <td>{{ __('dashboard.search.search_name') }}</td>
                <td>{{ __('dashboard.search.search_type') }}</td>
                <td>{{ __('dashboard.search.search_count') }}</td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--searchData" data-load-error="{{ __('dashboard.search.load_error') }}">
                @include('dashboard.dashboardSearch.partials.searchStatList')
            </tbody>
        </table>
        <div class="dashboard_searchDataPagination d-flex justify-content-center mt-4">
            {{ $allData->links() }}
        </div>
    </div>
</div>
@endsection