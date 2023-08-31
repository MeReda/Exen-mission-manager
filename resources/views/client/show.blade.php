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
        <p><strong>Companion:</strong> {{ $mission->companion }}</p>
        <p><strong>Budget:</strong> {{ $mission->budget }} DH</p>
        <p><strong>State:</strong> {{ $mission->state }}</p>
        @if ($mission->total_reimbursement != null)
            <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
        @endif
        @if ($mission->comment != null)
            <p><strong>Comment:</strong> {{ $mission->comment }}</p>
        @endif
    </div>

    @include('client.expenses')
@endsection
