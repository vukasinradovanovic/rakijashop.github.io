@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">{{ __('dashboard.index.title') }}</h2>
<hr class="border border-gray border-2">
<div class="dashboard_index container-fluid m-auto p-3">
    <div class="dashboard_UserInfo container-fluid m-auto">
        <h4>{{ __('dashboard.index.logged_in') }}</h4>
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>{{ __('dashboard.index.role') }}</td>
                    <td>{{ __('dashboard.index.full_name') }}</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--users">
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $role }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr class="border border-gray border-2">
<div class="dashboard_index container-fluid m-auto p-3">
    <div class="dashboard_UserInfo container-fluid m-auto">
        <h4 class="text-center">{{ __('dashboard.index.site_info') }}</h4>
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <td>{{ __('dashboard.index.info_name') }}</td>
                <td>{{ __('dashboard.index.count') }}</td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--users">
                <tr>
                    <td>{{ __('dashboard.index.total_users') }}</td>
                    <td>{{ $usersCount }}</td>
                </tr>
                <tr>
                    <td>{{ __('dashboard.index.active_users') }}</td>
                    <td>{{ $activeUsersCount }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection