@extends('dashboard.layout.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Mission Request</h1>
    </div>

    {{-- Add mission modal --}}
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Object</th>
                <th>Place</th>
                <th>Start Date</th>
                <th>Duration</th>
                <th>Employee</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mission_requests as $mission)
                @php
                    $start_date = \Carbon\Carbon::parse($mission->start_date);
                    $end_date = \Carbon\Carbon::parse($mission->end_date);
                @endphp
                <tr>
                    <td>{{ $mission->name }}</td>
                    <td>{{ $mission->object }}</td>
                    <td>{{ $mission->place }}</td>
                    <td>{{ $mission->start_date }}</td>
                    <td>{{ $start_date->diffInDays($end_date) }} days</td>
                    <td>{{ $mission->user->fname }} {{ $mission->user->lname }} </td>
                    <td>
                        <a href="{{-- route('mission_requests.show', $mission->id) --}}" class="btn btn-sm">
                            <i class="fs-4 fa-solid fa-circle-info text-info"></i>
                        </a>
                        <form action="{{-- route('mission_requests.destroy', $mission->id) --}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm">
                                <i class="fs-4 fa-solid fa-circle-xmark text-danger"></i>
                            </button>
                        </form>

                        <button class="btn btn-sm" data-toggle="modal" data-target="#approveMissionModal">
                            <i class="fs-4 fa-solid fa-check text-success"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Show missions table --}}

    {{-- Show mission detail modal --}}

    {{-- Edit Mission --}}

    {{-- Approve Expenses Modal --}}

    {{-- Print mission info & reimbursement request --}}
@endsection
