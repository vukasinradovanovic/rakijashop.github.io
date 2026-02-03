@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">Korisnici</h2>
<hr class="border border-gray border-2">
<div class="dashboard_User container-fluid m-auto p-3">
    <div class="col-12 col-md-6 m-2">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
            <input type="search" name="userSearch" class="dashboard_UserSearch form-control"
                placeholder="Pretražite korisnička imena...">
        </div>
    </div>
    <div class="dashboard_UserInfo container-fluid m-auto">
        <table class="table_dashboardGeneral table_dashboardGeneral--users">
            <thead>
                <td>ID</td>
                <td>Dodeljeno korisničko ime</td>
                <td>Promenjeno korisničko ime</td>
                <td>Ime i prezime</td>
                <td>Email</td>
                <td>Rola</td>
                <td>Status</td>
                <td></td>
            </thead>
            <tbody class="table_dashboardGeneralTbody table_dashboardGeneralTbody--users">
                {{-- Script --}}
            </tbody>
        </table>
    </div>
</div>
@endsection