<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Mission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.mission.store') }}" method="post">
                @csrf
                <div class="modal-body  modal-dialog-scrollable">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" required autofocus='true'>
                    </div>
                    <div class="form-group">
                        <label for="name">Object:</label>
                        <input type="text" class="form-control" name="object" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Description:</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Place:</label>
                        <input type="text" class="form-control" name="place" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required
                            min="{{ date('Y-m-d') }}" onchange="updateDateMin()">
                    </div>
                    <div class="form-group">
                        <label for="name">End Date:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required
                            onchange="updateDateMax()">
                    </div>
                    <div class="form-group">
                        <label for="name">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Companion:</label>
                        <input type="text" class="form-control" name="companion" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Budget:</label>
                        <input type="text" class="form-control" name="budget" required>
                    </div>
                    <div class="form-group">
                        <label for="name">User ID:</label>
                        <select name="user_id" class="form-control" required>
                            <option value="" selected disabled>Select User ID</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->lname }}</option>
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
                    <button type="submit" class="btn btn-success">Add</button>
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
