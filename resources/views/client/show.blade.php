@extends('client.layout')

@section('content')
    <h1 class="text-center m-5">Mission info</h1>

    <div class="bg-white p-3">
        <p><strong>ID:</strong> {{ $mission->id }}</p>

        <p><strong>Name:</strong> {{ $mission->name }}</p>

        <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>

        <p><strong>Object:</strong> {{ $mission->object }}</p>

        <p><strong>Description:</strong> {{ $mission->description }}</p>

        <p><strong>Place:</strong> {{ $mission->place }}</p>

        <p><strong>Date:</strong> {{ $mission->date }}</p>

        <p><strong>Start Date:</strong> {{ $mission->start_date }}</p>

        <p><strong>End Date:</strong> {{ $mission->end_date }}</p>

        <p><strong>Companion: </strong>
            @if ($mission->companion != null)
                {{ $mission->companion }}
            @else
                Not defined
            @endif
        </p>

        <p><strong>Budget: </strong>
            @if ($mission->budget != null)
                {{ $mission->budget }} DH
            @else
                Not defined
            @endif
        </p>

        <p><strong>State:</strong> {{ $mission->state }}</p>

        @if ($mission->total_reimbursement != null)
            <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
        @endif

        @if ($mission->comment != null)
            <p><strong>Comment:</strong> {{ $mission->comment }}</p>
        @endif

        <p><strong>Reimbursement State:</strong> {{ $mission->reimbursement_state }}</p>
    </div>

    @include('client.expenses')
@endsection
