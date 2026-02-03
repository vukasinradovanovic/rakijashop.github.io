@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">Dashboard</h2>
<hr class="border border-gray border-2">
<div class="dashboard_index container-fluid m-auto p-3">
    <div class="dashboard_UserInfo container-fluid m-auto">
        <h4>Prijavljen:</h4>
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Rola</td>
                    <td>Ime i prezime</td>
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
        <h4 class="text-center">Informacije sajta</h4>
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <td>Ime informacije</td>
                <td>Broj</td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--users">
                <tr>
                    <td>Ukupan broj korisnika</td>
                    <td>{{ $usersCount }}</td>
                </tr>
                <tr>
                    <td>Aktivni korisnici</td>
                    <td>{{ $activeUsersCount }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection