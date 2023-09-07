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
        <div class="mb-3 mission-card">
            <div class="card-body">
                <h5 class="card-title text-center">no missions</h5>
            </div>
        </div>
    @endforelse

    {{-- Show mission requests --}}
    <h1 class="text-center m-5 pt-5">My Mission Requests</h1>

    {{-- Create mission request --}}
    <button class="btn btn-success float-end mb-3" data-bs-toggle="modal" data-bs-target="#createMissionRequestModal">
        Create Mission Request
    </button>

    @forelse ($mission_requests as $mission_request)
        <a href="{{ route('client.showMissionRequest', $mission_request->id) }}"
            class="mission-card mb-3 p-3 px-md-5 gap-3 @if ($mission_request->status != 'pending') opacity-50 @endif">
            <p class="m-0">{{ $mission_request->name }}</p>
            <p class="m-0">{{ $mission_request->object }}</p>
            <p class="m-0">{{ $mission_request->date }}</p>
        </a>
    @empty
        <div class="mb-3 mission-card opacity-50">
            <div class="card-body">
                <h5 class="card-title text-center p-3 text-secondary">no mission requests</h5>
            </div>
        </div>
    @endforelse

    {{-- create mission modal --}}
    <div class="modal fade" id="createMissionRequestModal" tabindex="-1" aria-labelledby="createMissionRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createMissionRequestModalLabel">Create Mission Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('client.storeMissionRequest') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Mission Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Mission Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="object" class="form-label">Mission Object</label>
                            <input type="text" class="form-control" id="object" name="object"
                                placeholder="Mission Object" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mission Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mission Description"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="place" class="form-label">Mission Place</label>
                            <input class="form-control" id="place" name="place" placeholder="Mission Place" required>
                        </div>
                        <div class="mb-3">
                            <label for="name">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required
                                min="{{ date('Y-m-d') }}" onchange="updateDateMin()">
                        </div>
                        <div class="mb-3">
                            <label for="name">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required
                                onchange="updateDateMax()">
                        </div>
                        <div class="mb-3">
                            <label for="name">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Companion Name</label>
                            <select name="companion" id="companion" class="form-select">
                                <option value="" selected>Choose Companion</option>
                                @foreach ($users as $companion)
                                    <option value="{{ $companion->fname }} {{ $companion->lname }}">
                                        {{ $companion->fname }} {{ $companion->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Show errors --}}
                        @if ($errors->any())
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '{{ $errors->first() }}'
                                });
                            </script>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const dateInput = document.getElementsByName('date')[0];

        startDateInput.addEventListener('change', () => {
            dateInput.min = startDateInput.value;
        });

        endDateInput.addEventListener('change', () => {
            dateInput.max = endDateInput.value;
        });

        function updateDateMin() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            var dateInput = document.getElementById('date');

            endDateInput.min = startDateInput.value;
            dateInput.min = startDateInput.value;
        }

        function updateDateMax() {
            var endDateInput = document.getElementById('end_date');
            var dateInput = document.getElementById('date');
            dateInput.max = endDateInput.value;
        }
    </script>
@endsection
