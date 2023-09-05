@foreach ($missions as $mission)
    <div class="modal fade" id="missionEditModal{{ $mission->id }}" tabindex="-1"
        aria-labelledby="missionDetailModalLabel{{ $mission->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionDetailModalLabel{{ $mission->id }}">Mission Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.mission.update', $mission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-user">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" required
                                value="{{ $mission->name }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Object:</label>
                            <input type="text" class="form-control" name="object" required
                                value="{{ $mission->object }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Description:</label>
                            <input type="text" class="form-control" name="description" required
                                value="{{ $mission->description }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Place:</label>
                            <input type="text" class="form-control" name="place" required
                                value="{{ $mission->place }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" required
                                value="{{ $mission->start_date }}">
                        </div>

                        <div class="form-user">
                            <label for="name">End Date:</label>
                            <input type="date" class="form-control" name="end_date" required
                                value="{{ $mission->end_date }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Date:</label>
                            <input type="date" class="form-control" name="date" required
                                value="{{ $mission->date }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Companion:</label>
                            <select name="companion" class="form-select">
                                <option value="" selected disabled>Select User ID</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->fname }} {{ $user->lname }}"
                                        {{ $user->fname . ' ' . $user->lname == $mission->companion ? 'selected' : '' }}>
                                        {{ $user->fname }} {{ $user->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-user">
                            <label for="name">Budget:</label>
                            <input type="text" class="form-control" name="budget" value="{{ $mission->budget }}">
                        </div>

                        <div class="form-user">
                            <label for="name">User ID:</label>
                            <select name="user_id" class="form-select" required>
                                <option value="" selected disabled>Select User ID</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $mission->user->id ? 'selected' : '' }}>
                                        {{ $user->fname }} {{ $user->lname }}
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
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
