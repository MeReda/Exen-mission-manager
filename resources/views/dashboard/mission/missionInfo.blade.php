@extends('dashboard.layout.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Missions Info</h1>
    </div>

    <div class="bg-white p-5">
        <p><strong>ID:</strong> {{ $mission->id }}</p>

        <p><strong>Name:</strong> {{ $mission->name }}</p>

        <p><strong>Object:</strong> {{ $mission->object }}</p>

        <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>

        <p><strong>Description:</strong> {{ $mission->description }}</p>

        <p><strong>Place:</strong> {{ $mission->place }}</p>

        <div class="row">
            <div class="col-4">
                <p><strong>Start date:</strong> {{ $mission->start_date }}</p>
            </div>
            <div class="col-4">
                <p><strong>Date:</strong> {{ $mission->date }}</p>
            </div>
            <div class="col-4">
                <p><strong>End date:</strong> {{ $mission->end_date }}</p>
            </div>
        </div>

        <p><strong>Companion:</strong> {{ $mission->companion }} </p>

        @if ($mission->budget)
            <p><strong>Budget:</strong> {{ $mission->budget }} DH</p>
        @endif

        <p><strong>Mission State:</strong> {{ $mission->state }}</p>

        <p><strong>Reimbursement State:</strong> {{ $mission->reimbursement_state }}</p>

        @if ($mission->total_reimbursement)
            <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
        @endif

        @if ($mission->comment)
            <p><strong>Comment:</strong> {{ $mission->comment }}</p>
        @endif

    </div>
@endsection
