@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.errors.title') }}</h2>
<hr class="border border-gray border-2">

<div class="dashboard_Logs container-fluid m-auto p-3"
    data-search-url="{{ route('dashboard-errors.search') }}">
    <div class="col-12 col-md-6 m-2">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input type="search" name="errorLogSearch" class="dashboard_LogsSearch form-control"
                placeholder="{{ __('dashboard.errors.search_placeholder') }}">
        </div>
    </div>

    <div class="dashboard_LogsInfo container-fluid m-auto">
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>{{ __('dashboard.errors.error_code') }}</td>
                    <td>{{ __('dashboard.errors.user') }}</td>
                    <td>{{ __('dashboard.errors.route') }}</td>
                    <td>{{ __('dashboard.errors.path') }}</td>
                    <td>{{ __('dashboard.errors.time') }}</td>
                </tr>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--logs"
                data-guest-label="{{ __('dashboard.errors.guest') }}"
                data-no-data-label="{{ __('dashboard.errors.no_data') }}">
                {{-- Script --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
