<div class="modal fade" id="addGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Group</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('dashboard.group.store') }}">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="percentage">Percentage %:</label>
                        <input type="number" class="form-control" name="percentage" required>
                    </div>
                    {{-- show percentage error message --}}
                    @error('percentage')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Group</button>
                </div>
            </form>
        </div>
    </div>
</div>
