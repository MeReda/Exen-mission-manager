@foreach ($users as $user)
    <div class="modal fade" id="userEditModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="userDetailModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailModalLabel{{ $user->id }}">User Edit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('dashboard.user.update', $user->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-user">
                            <label for="name">First Name:</label>
                            <input type="text" class="form-control" name="fname" required
                                value="{{ $user->fname }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Last Name:</label>
                            <input type="text" class="form-control" name="lname" required
                                value="{{ $user->lname }}">
                        </div>

                        <div class="form-user">
                            <label for="name">CIN:</label>
                            <input type="text" class="form-control" name="CIN" required
                                value="{{ $user->CIN }}">
                        </div>

                        <div class="form-user">
                            <label for="name">E-mail:</label>
                            <input type="email" class="form-control" name="email" required
                                value="{{ $user->email }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Profile:</label>
                            <input type="text" class="form-control" name="profile" required
                                value="{{ $user->profile }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Group ID:</label>
                            <input type="number" class="form-control" name="group_id" required
                                value="{{ $user->group_id }}">
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
