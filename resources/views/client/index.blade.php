@extends('client.layout')

@section('content')
    <h1 class="text-center m-5">My Missions</h1>

    {{-- Show missions --}}
    @forelse ($missions as $mission)
        <a href="{{ route('client.show', $mission->id) }}"
            class="mission-card mb-3 p-3 px-md-5 gap-3  @if ($mission->state != 'incomplete') opacity-50 @endif">
            <p class="m-0">{{ $mission->name }}</p>
            <p class="m-0">{{ $mission->object }}</p>
            <p class="m-0">{{ $mission->date }}</p>
        </a>
    @empty
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">no missions</h5>
            </div>
        </div>
    @endforelse
@endsection
