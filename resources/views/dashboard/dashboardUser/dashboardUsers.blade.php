@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.users.title') }}</h2>
<hr class="border border-gray border-2">
<div class="dashboard_User container-fluid m-auto p-3">
    <div class="col-12 col-md-6 m-2">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input type="search" name="userSearch" class="dashboard_UserSearch form-control"
                placeholder="{{ __('dashboard.users.search_placeholder') }}">
        </div>
    </div>
    <div class="dashboard_UserInfo container-fluid m-auto">
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <td>ID</td>
                <td>{{ __('dashboard.users.assigned_username') }}</td>
                <td>{{ __('dashboard.users.edited_username') }}</td>
                <td>{{ __('dashboard.users.full_name') }}</td>
                <td>Email</td>
                <td>{{ __('dashboard.users.role') }}</td>
                <td>{{ __('dashboard.users.status') }}</td>
                <td></td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--users"
                data-reset-label="{{ __('dashboard.users.reset') }}"
                data-change-label="{{ __('dashboard.users.change') }}"
                data-no-data-label="{{ __('dashboard.users.no_data') }}"
                data-update-error="{{ __('dashboard.users.update_error') }}">
                {{-- Script --}}
            </tbody>
        </table>
    </div>
</div>
@endsection