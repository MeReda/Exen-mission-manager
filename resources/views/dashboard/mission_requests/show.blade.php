@foreach ($mission_requests as $mission)
    <div class="modal fade" id="showMissionRequestModal{{ $mission->id }}" tabindex="-1"
        aria-labelledby="showMissionRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showMissionRequestModalLabel">Mission Request info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Id:</strong> {{ $mission->id }}</p>
                    <p><strong>Name:</strong> {{ $mission->name }}</p>
                    <p><strong>Object:</strong> {{ $mission->object }}</p>
                    <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }} </p>
                    <p><strong>Description:</strong> {{ $mission->description }}</p>
                    <p><strong>Place:</strong> {{ $mission->place }}</p>
                    <p><strong>Start Date:</strong> {{ $mission->start_date }}</p>
                    <p><strong>Date:</strong> {{ $mission->date }}</p>
                    <p><strong>End Date:</strong> {{ $mission->end_date }}</p>
                    <p><strong>Companion:</strong>
                        @if ($mission->companion)
                            {{ $mission->companion }}
                        @else
                            Not defined
                        @endif
                    </p>
                    <p><strong>Status:</strong> {{ $mission->status }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
