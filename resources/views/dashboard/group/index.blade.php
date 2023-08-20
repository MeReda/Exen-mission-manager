@extends('dashboard.layout.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Groups</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGroup">
            <i class="fa-solid fa-plus"></i>
            Add Group
        </button>
    </div>

    {{-- Add Group modal --}}
    @include('dashboard.group.create')

    {{-- Show all Groups --}}
    @include('dashboard.group.all')

    {{-- Show Group Detail --}}
    @include('dashboard.group.show')

    {{-- Edit Group --}}
    @include('dashboard.group.edit')
@endsection
