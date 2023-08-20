@foreach ($users as $user)
    <div class="modal fade" id="userDetailModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="userDetailModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailModalLabel{{ $user->id }}">{{ $user->name }} Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>First Name:</strong> {{ $user->fname }}</p>
                    <p><strong>Last Name:</strong> {{ $user->lname }} </p>
                    <p><strong>CIN:</strong> {{ $user->CIN }}</p>
                    <p><strong>E-mail:</strong> {{ $user->email }}</p>
                    <p><strong>Profile:</strong> {{ $user->profile }}</p>
                    <p><strong>Group:</strong> {{ $user->group->name }}</p>
                    <p><strong>missions:</strong>
                    <ul>
                        @foreach ($user->missions as $mission)
                            <li>{{ $mission->name }}</li>
                        @endforeach
                    </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
