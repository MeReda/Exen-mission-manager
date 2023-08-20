<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Object:</label>
                        <input type="text" class="form-control" name="object" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Description:</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Place:</label>
                        <input type="text" class="form-control" name="place" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required
                            min="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Companion:</label>
                        <input type="text" class="form-control" name="companion" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Budget:</label>
                        <input type="text" class="form-control" name="budget" required>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">User ID:</label>
                        <input type="text" class="form-control" name="user_id" required>
                    </div>
                </div>

                {{-- Show errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li class="m-0">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Add</button>
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
</script>
