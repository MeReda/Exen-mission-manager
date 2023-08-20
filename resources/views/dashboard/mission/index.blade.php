@extends('dashboard.layout.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Missions</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus"></i>
            Add mission
        </button>
    </div>

    {{-- Add mission modal --}}
    @include('dashboard.mission.create')

    {{-- Show missions table --}}
    @include('dashboard.mission.all')

    {{-- Show mission detail modal --}}
    @include('dashboard.mission.show')

    {{-- Edit Mission --}}
    @include('dashboard.mission.edit')

    {{-- Approve Expenses Modal --}}
    @include('dashboard.mission.approve')

    {{-- Print mission info & reimbursement request --}}
    @include('dashboard.mission.print')
@endsection
