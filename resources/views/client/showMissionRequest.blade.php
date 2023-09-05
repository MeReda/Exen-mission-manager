@extends('client.layout')

@section('content')
    <h1 class="text-center m-5">Mission Request info</h1>

    <div class="bg-white p-3">
        {{-- crud buttons --}}
        @if ($mission_request->status == 'pending')
            <div class="d-flex float-end">
                <button type="button" class="btn btn-success me-3" data-bs-toggle="modal"
                    data-bs-target="#editMissionRequestModal">
                    <i class="fa-solid fa-edit"></i>
                </button>

                <form action="{{ route('client.destroyMissionRequest', $mission_request->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        @endif

        {{-- mission request info --}}
        <p><strong>ID:</strong> {{ $mission_request->id }}</p>

        <p><strong>Name:</strong> {{ $mission_request->name }}</p>

        <p><strong>Object:</strong> {{ $mission_request->object }}</p>

        <p><strong>description:</strong> {{ $mission_request->description }}</p>

        <p><strong>place:</strong> {{ $mission_request->place }}</p>

        <p><strong>Start Date:</strong> {{ $mission_request->start_date }}</p>

        <p><strong>date:</strong> {{ $mission_request->date }}</p>

        <p><strong>End Date:</strong> {{ $mission_request->end_date }}</p>

        <p><strong>Companion:</strong>
            @if ($mission_request->companion != null)
                {{ $mission_request->companion }}
            @else
                Not defined
            @endif
        </p>

        <p><strong>Status:</strong>
            @if ($mission_request->status == 'rejected')
                <span class="text-danger">{{ $mission_request->status }}</span>
            @elseif($mission_request->status == 'accepted')
                <span class="text-success">{{ $mission_request->status }}</span>
            @else
                {{ $mission_request->status }}
            @endif
        </p>
    </div>

    {{-- edit mission request modal --}}

    <div class="modal fade" id="editMissionRequestModal" tabindex="-1" aria-labelledby="editMissionRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMissionRequestModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('client.updateMissionRequest', $mission_request->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Mission Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Mission Name" required value="{{ $mission_request->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="object" class="form-label">Mission Object</label>
                            <input type="text" class="form-control" id="object" name="object"
                                placeholder="Mission Object" required value="{{ $mission_request->object }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mission Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Mission Description" required value="{{ $mission_request->description }}">
                        </div>

                        <div class="mb-3">
                            <label for="place" class="form-label">Mission Place</label>
                            <input type="text" class="form-control" id="place" name="place"
                                placeholder="Mission Place" required value="{{ $mission_request->description }}">
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
                            <label for="companion" class="form-label">Companion</label>
                            <select name="companion" id="companion" class="form-select">
                                <option value="" selected>Choose Companion</option>
                                @foreach ($users as $companion)
                                    <option value="{{ $companion->fname }} {{ $companion->lname }}"
                                        @if ($companion->fname . ' ' . $companion->lname === $mission_request->companion) selected @endif>
                                        {{ $companion->fname }} {{ $companion->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
