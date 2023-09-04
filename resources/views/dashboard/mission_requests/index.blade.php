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
                <tr class="@if ($mission->status == 'pending') table-warning @endif">
                    <td>{{ $mission->name }}</td>
                    <td>{{ $mission->object }}</td>
                    <td>{{ $mission->place }}</td>
                    <td>{{ $mission->start_date }}</td>
                    <td>{{ $start_date->diffInDays($end_date) }} days</td>
                    <td>{{ $mission->user->fname }} {{ $mission->user->lname }} </td>
                    <td class="d-flex text-center justify-content-center">
                        {{-- show mission request button --}}
                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                            data-bs-target="#showMissionRequestModal{{ $mission->id }}">
                            <i class="fs-4 fa-solid fa-circle-info text-info"></i>
                        </button>

                        @if ($mission->status == 'pending')
                            {{-- approve mission request button --}}
                            <button class="btn btn-sm" data-toggle="modal" data-target="#approveMissionModal">
                                <i class="fs-4 fa-solid fa-circle-check text-success"></i>
                            </button>

                            {{-- reject mission request button --}}
                            <form action="{{ route('dashboard.mission.requests.reject', $mission->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                                <button type="submit" class="btn btn-sm">
                                    <i class="fs-4 fa-solid fa-circle-xmark text-danger"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Show mission request info --}}
    @include('dashboard.mission_requests.show')
@endsection
