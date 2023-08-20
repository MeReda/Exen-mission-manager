@extends('dashboard.layout.index')

@section('content')
    <h2 class="my-5">Dashboard</h2>

    <div class="row gap-5 justify-content-center align-items-center h-75 text-center">
        <div class="dashboard-card col-2 p-5 rounded-5">
            <h3>Missions</h3>
            <h1 class="mt-5">{{ $missions }}</h1>
        </div>

        <div class="dashboard-card col-2 p-5 rounded-5">
            <h3>Archived Missions</h3>
            <h1 class="mt-3">{{ $deleted_missions }}</h1>
        </div>

        <div class="dashboard-card col-2 p-5 rounded-5">
            <h3>Groups</h3>
            <h1 class="mt-5">{{ $groups }}</h1>
        </div>

        <div class="dashboard-card col-2 p-5 rounded-5">
            <h3>Users</h3>
            <h1 class="mt-5">{{ $users }}</h1>
        </div>
    </div>
@endsection
