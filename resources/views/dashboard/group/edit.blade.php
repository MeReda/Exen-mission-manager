@foreach ($groups as $group)
    <div class="modal fade" id="groupEditModal{{ $group->id }}" tabindex="-1"
        aria-labelledby="groupDetailModalLabel{{ $group->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupDetailModalLabel{{ $group->id }}">Group Edit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('dashboard.group.update', $group->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" required
                                value="{{ $group->name }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="percentage">Percentage %:</label>
                            <input type="number" class="form-control" name="percentage" required
                                value="{{ $group->percentage }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
