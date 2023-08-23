@foreach ($groups as $group)
    <div class="modal fade" id="groupDetailModal{{ $group->id }}" tabindex="-1"
        aria-labelledby="groupDetailModalLabel{{ $group->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupDetailModalLabel{{ $group->id }}">{{ $group->name }} Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> {{ $group->name }}</p>
                    <p><strong>Percentage:</strong> {{ $group->percentage }}%</p>
                    <p><strong>Members:</strong></p>
                    <ul>
                        @foreach ($group->users as $user)
                            <li>{{ $user->fname }} {{ $user->lname }} - <em>{{ $user->profile }}</em></li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
