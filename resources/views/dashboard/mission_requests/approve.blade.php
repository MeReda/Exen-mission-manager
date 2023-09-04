@foreach ($mission_requests as $mission)
    <div class="modal fade" id="approveMissionRequestModal{{ $mission->id }}" tabindex="-1"
        aria-labelledby="approveMissionRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveMissionRequestModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.mission.requests.approve', $mission->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $mission->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="object" class="form-label">Object</label>
                            <input type="text" class="form-control" id="object" name="object"
                                value="{{ $mission->object }}">
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Employee</label>
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="" selected disabled>Choose Employee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if ($user->id === $mission->user_id) selected @endif>
                                        {{ $user->fname }} {{ $user->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ $mission->object }}">
                        </div>

                        <div class="mb-3">
                            <label for="place" class="form-label">Place</label>
                            <input type="text" class="form-control" id="place" name="place"
                                value="{{ $mission->place }}">
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ $mission->date }}">
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ $mission->start_date }}">
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ $mission->end_date }}">
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
                        <button type="submit" class="btn btn-success">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
