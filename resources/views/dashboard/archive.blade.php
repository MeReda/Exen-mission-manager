@extends('dashboard.layout.index')

@section('content')
    <h1 class="my-5">Archive</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Object</th>
                <th>Place</th>
                <th>Date</th>
                <th>Duration</th>
                <th>Companion</th>
                <th>Budget</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archive as $mission)
                @php
                    $start_date = \Carbon\Carbon::parse($mission->start_date);
                    $end_date = \Carbon\Carbon::parse($mission->end_date);
                @endphp
                <tr>
                    <td class="p-3">{{ $mission->name }}</td>
                    <td class="p-3">{{ $mission->object }}</td>
                    <td class="p-3">{{ $mission->place }}</td>
                    <td class="p-3">{{ $mission->date }}</td>
                    <td class="p-3">{{ $start_date->diffInDays($end_date) }} days</td>
                    <td class="p-3">{{ $mission->companion }}</td>
                    <td class="p-3">{{ $mission->budget }} DH</td>
                    <td class="text-center d-flex">
                        <form action="{{ route('dashboard.archive.restore', ['id' => $mission->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm fs-4 py-0 text-success">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            </button>
                        </form>

                        <a href="{{ route('dashboard.archive.destroy', $mission->id) }}"
                            class="text-danger fs-4 fa-solid fa-trash-can pt-2 ms-2" data-confirm-delete="true">
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $archive->links() }}
    </div>
@endsection
