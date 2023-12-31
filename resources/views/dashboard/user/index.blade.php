@extends('dashboard.layout.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Employees</h1>
        <div>
            <a href="{{ route('dashboard.user.print') }}" class="btn btn-secondary">
                <i class="fa-solid fa-print"></i>
                Print Employees
            </a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUser">
                <i class="fa-solid fa-plus"></i>
                Add Employee
            </button>
        </div>

    </div>

    {{-- Create user --}}
    @include('dashboard.user.create')

    {{-- Show all users --}}
    @include('dashboard.user.all')


    {{-- Show user detail --}}
    @include('dashboard.user.show')


    {{-- Edit user --}}
    @include('dashboard.user.edit')
@endsection
