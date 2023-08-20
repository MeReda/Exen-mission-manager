@foreach ($missions as $mission)
    <div class="modal fade" id="missionDetailModal{{ $mission->id }}" tabindex="-1"
        aria-labelledby="missionDetailModalLabel{{ $mission->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionDetailModalLabel{{ $mission->id }}">{{ $mission->name }} Details
                    </h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> {{ $mission->id }}</p>
                    <p><strong>Name:</strong> {{ $mission->name }}</p>
                    <p><strong>Object:</strong> {{ $mission->object }}</p>
                    <p><strong>Description:</strong> {{ $mission->description }}</p>
                    <p><strong>Place:</strong> {{ $mission->place }}</p>
                    <p><strong>Date:</strong> {{ $mission->date }}</p>
                    <p><strong>Start Date:</strong> {{ $mission->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $mission->end_date }}</p>
                    <p><strong>Companion:</strong> {{ $mission->companion }}</p>
                    <p><strong>Budget:</strong> {{ $mission->budget }} DH</p>
                    <p><strong>State:</strong> {{ $mission->state }}</p>
                    <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
                    <p><strong>Comment:</strong> {{ $mission->comment }}</p>
                    <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
